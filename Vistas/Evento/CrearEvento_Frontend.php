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
    <title>Crear Evento</title>
</head>
<body>
    <h3>Crear evento</h3>
    <form method="post" action="CrearEvento_Backend.php" enctype="multipart/form-data">
        Titulo de evento: <input type="text" name="titu" required><br>
        Direccion de evento: <input type="text" name="dire" required><br>
        Comienza - (Hora y fecha): <input type="time" name="inih" required><input type="date" name="inif" required><br>
        Termina - (Hora y fecha): <input type="time" name="endh" required><input type="date" name="endf" required><br>
        Logo de evento: <input type="text" name="name" required placeholder="Nombre de logo"><input type="file" name="logo" accept="image/*" required><br>
        Descripcion de evento:  <br><textarea name="ede" rows="5" cols="30" placeholder="Escribe aquí..." required></textarea><br>
        Descripcion de organizador:  <br><textarea name="ode" rows="5" cols="30" placeholder="Escribe aquí..." required></textarea><br>
        <h3>Tickets:</h3>
        <input type="text" name="tipo1" placeholder="Nombre de ticket" required><input type="number" name="qty1" placeholder="Cantidad" min="1" step="1" required><input type="number" name="precio1" placeholder="$" min="1" step="0.1" required><br>
        <h4>Opcionales:</h4>
        <input type="text" name="tipo2" placeholder="Nombre de ticket"><input type="number" name="qty2" placeholder="Cantidad" min="1" step="1"><input type="number" name="precio2" placeholder="$" min="1" step="0.1"><br>
        <input type="text" name="tipo3" placeholder="Nombre de ticket"><input type="number" name="qty3" placeholder="Cantidad" min="1" step="1"><input type="number" name="precio3" placeholder="$" min="1" step="0.1"><br>
        <input type="text" name="tipo4" placeholder="Nombre de ticket"><input type="number" name="qty4" placeholder="Cantidad" min="1" step="1"><input type="number" name="precio4" placeholder="$" min="1" step="0.1"><br>
        <input type="text" name="tipo5" placeholder="Nombre de ticket"><input type="number" name="qty5" placeholder="Cantidad" min="1" step="1"><input type="number" name="precio5" placeholder="$" min="1" step="0.1"><br><br>

        <input type="submit" name="bton0">
        
    </form>
</body>
</html>