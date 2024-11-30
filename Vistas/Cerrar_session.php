<?php
require_once '../Session/Session_user.php';
$userSession = new User_session();
$userSession->cerrar_sesion();
header('Location: ../Login/Login_Frontend.php'); 
