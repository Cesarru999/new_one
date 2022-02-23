<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['name'])) {
        header('location: app/index.php');
    }
    if (isset($_SESSION['message'])) {
        echo "<h3 class='error'>" . $_SESSION['message'] . "</h3>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['message1'])) {
        echo "<h3 class='green'>" . $_SESSION['message1'] . "</h3>";
        unset($_SESSION['message1']);
    }
    ?>
    <div class="form" id="login">
        <form action="logica/log.php" method="POST">
            <label>Email:</label><br>
            <input type="email" name="email" placeholder="ejemplo@email.com" required><br>
            <label>Password:</label><br>
            <input type="password" id="pass" name="pass"><br>
            <label><input type="checkbox" id="ch"> Ver Contraseña</label><br>
            <div id="message"></div>
            <input type="submit" id="send">
        </form>
        <p class="other">Aún No estas registrado? <a class="link" onclick="change()">Registrate aqui!</a></p>
    </div>
    <div class="form2 hide" id="register">
        <form action="logica/reg.php" method="POST">

            <label>Nombre:</label><br>
            <input type="text" name="admin" required><br>
            <label>Email:</label><br>
            <input type="email" name="email_U" placeholder="ejemplo@email.com" required><br>
            <label>Password:</label><br>
            <input type="password" id="pass1" placeholder="Mas de 8 caracteres" name="pass" pattern=".{8,}"><br>
            <label><input type="checkbox" id="ch1"> Ver Contraseña</label><br>
            <div id="message"></div>
            <input type="submit" id="send">
        </form><br>
        <p class="other">Ya tienes una cuenta? <a class="link" onclick="change()">Inicia sesion</a></p>
    </div>
    <script type="text/javascript" src="js/login.js"></script>
</body>

</html>