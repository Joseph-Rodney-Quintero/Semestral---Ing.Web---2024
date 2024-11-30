<?php

class User_session{

    public function __construct(){
        session_start();
    }

    public function UserSession_actual($user){
        $_SESSION['user'] = $user;

    }

    public function Obtener_user($user){
        require '../Config_db/Conexion_db.php';
        require '../Config_db/Metodos_db.php';
        $database = new connection_db();
        $db = $database->conectar();
        $metodos = new Metodos_users($db);
        $usuario = $metodos->Buscar_user($user);
        return $usuario['name_last'];

    }
    public function cerrar_sesion(){
        session_unset();
        session_destroy();
    }


}