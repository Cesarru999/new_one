<?php
session_start();

if (!isset($_POST['negocio'])) {
    $_SESSION['message'] = "Acceso Denegado!";
    header('location: ../index.php');
}
include 'config.php';
$name = "Empty";
$mail_n = "Empty";
$tel = "Empty";

$query = "INSERT INTO negocio(id_N, nombre, email, phone) VALUES('','" . $name . "','" . $mail_n . "','" . $tel . "')";

if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
    echo $query;


    $stmt = $conn->prepare("SELECT id_N FROM negocio ORDER BY id_N DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $result->num_rows;
    $row = $result->fetch_assoc();
    $id = $row['id_N'];


    $name_U = $_POST['admin'];
    $mail_U = $_POST['email_U'];
    $pass = $_POST['pass'];

    $query2 = "INSERT INTO user(id_U, nombre_U, email, password, id_N) VALUES('','" . $name_U . "','" . $mail_U . "','" . $pass . "','" . $id . "')";

    if ($conn->query($query2) === TRUE) {
        echo "New record created successfully";
        echo $query2;
        $_SESSION['message1'] = "Felicidades " . $name_U . "! Ya puedes ingresar en la cuenta de tu negocio";
        header('location: ../');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
        header('location: ../');
    }
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
    header('location: ../');
}
