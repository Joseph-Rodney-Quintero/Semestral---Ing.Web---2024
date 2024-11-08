<?php
if(isset($_POST['NameP']) && !empty($_POST['NameP'])){
    //Conectar a la base de datos
    require_once('../Config_db/Conexion_db.php');
    $database = new connection_db();
    $db = $database->conectar();



}