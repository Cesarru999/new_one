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
    
    <div class="form" id="login">
        <form action="logica/log.php" method="POST">
            <label>Email:</label><br>
            <input type="email" name="email" placeholder="ejemplo@email.com" required><br>
            <label>Password:</label><br>
            <input type="password" id="pass" name="pass" ><br>
            <label><input type="checkbox" id="ch"> Ver Contraseña</label><br>
            <div id="message"></div>
            <input type="submit" id="send">
        </form>
        <p class="other">Aún No estas registrado? <a class="link"">Registrate aqui!</a></p>
    </div>


</body>
</html> 