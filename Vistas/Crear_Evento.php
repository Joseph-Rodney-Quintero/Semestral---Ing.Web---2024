<?php
require '../Session/Session_user.php';
$user_sesion = New User_session();
if(isset($_SESSION['user'])){
    echo"<script> alert('Ya existe una sesion');document.location.href = '../Vistas/Home.php';</script>";
    //header('Location: ../Login/Login_Frontend.php');   
}