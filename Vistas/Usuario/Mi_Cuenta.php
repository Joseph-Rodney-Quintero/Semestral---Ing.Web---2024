<?php
require '../../Session/Session_user.php';
$user_sesion = New User_session();
if(!isset($_SESSION['user'])){
    echo"<script> alert('Debes iniciar sesión');document.location.href = '../Login/Login_Frontend.php';</script>";
    //header('Location: ../Login/Login_Frontend.php');   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    <h3>Info de usuario</h3>
    <a href="Editar_user.php" target="_blank">Editar usuario</a><br>
    <a href="Mis_Tickets.php" target="_blank">Mis Bolestos</a><br>
    <a href="../Home.php" target="_blank">Home</a>
    

    
</body>
</html>