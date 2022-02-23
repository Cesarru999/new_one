<?php
include 'config.php';
session_start();
if(!isset($_POST['email'])){
	$_SESSION['message'] = "Acceso Denegado!";
	header('location: ../index.php');
}
$user=$_POST['email']; 
$clave=$_POST['pass'];

$query="SELECT COUNT(*) as contar FROM acceso where email = '$user' and password = '$clave'";
$consulta = mysqli_query($conn,$query);
$array = mysqli_fetch_array($consulta);

if($array['contar']==1){
	$query1 = "SELECT * FROM acceso where email = '$user' and password = '$clave'";

	$resultado = $conn->query($query1);
	$row = $resultado->fetch_assoc();
	$name = $row['nombre_U'];
	$_SESSION['name']=$name;

	header('location: ../app/index.php');	
	
}else{

    $_SESSION['message'] = "Usuario o contraseña incorrecto!";
	header('location: ../index.php');
}

?>