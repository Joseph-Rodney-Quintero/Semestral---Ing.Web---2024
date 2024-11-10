<?php
if(isset($_POST['NameL']) && !empty($_POST['NameL']) && isset($_POST['passL']) && !empty($_POST['passL'])){
    $name = $_POST['NameL'];
    $pass = $_POST['passL'];

    try{
        //Conectar con la base de datos
        require '../Config_db/Conexion_db.php';
        require '../Config_db/Metodos_db.php';
        $database = new connection_db();
        $db = $database->conectar();
        $verificar = new Metodos_users($db);
        echo '<br>';
        $verificar->Login($name,$pass);
        
    }catch(PDOException $e){
        echo "Error de sentencia: " . $e->getMessage()."<br>";
        echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
        echo "Detalles adicionales:"."<br>";
        print_r($e->errorInfo);
    }

    
}