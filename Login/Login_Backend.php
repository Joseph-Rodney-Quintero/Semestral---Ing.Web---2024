<?php
/*require '../Session/Session.php';
if(isset($_SESSION['user'])){
    echo 'ya existe una session';

}*/
if(isset($_POST['NameL']) && !empty($_POST['NameL']) && isset($_POST['passL']) && !empty($_POST['passL'])){
    $name = $_POST['NameL'];
    $pass = $_POST['passL'];

    try{
        //Conectar con la base de datos
        require '../Config_db/Conexion_db.php';
        require '../Config_db/Metodos_db.php';
        require '../Session/Session_user.php';
        $database = new connection_db();
        $db = $database->conectar();
        $userSession = new User_session();
        $verificar = new Metodos_users($db);
        echo '<br>';
        if($verificar->Login($name,$pass)){
            $userSession->UserSession_actual($name);
            //echo $_SESSION['user'];
            header('Location: ../Vistas/Home.php');
        }else{
            $errorLogin = "Usuario y/o contraseña incorrecto";
            include_once 'Login_Frontend.php';
        }
        
    }catch(PDOException $e){
        echo "Error de sentencia: " . $e->getMessage()."<br>";
        echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
        echo "Detalles adicionales:"."<br>";
        print_r($e->errorInfo);
    }    
}