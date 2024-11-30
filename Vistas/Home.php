<?php
require '../Session/Session_user.php';
$user_sesion = New User_session();
if(isset($_SESSION['user'])){
    $user = $user_sesion->Obtener_user($_SESSION['user']);
      
}else{
    echo"<script> alert('Debes iniciar sesión');document.location.href = '../Login/Login_Frontend.php';</script>";
    //header('Location: ../Login/Login_Frontend.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Usuario</title>
</head>
<body>
    <h3>Bienvenido <?php echo $user['name_last'];  ?></h3>
    <a href="./Usuario/Mi_Cuenta.php">Mi Cuenta</a><br>
    <a href="Crear_Evento.php">Crear Evento</a><br>
    <a href="Cerrar_session.php">Cerrar Sesion</a><br>

    
    
</body>
</html>