<?php
if(isset($_POST['NameR']) && !empty($_POST['NameR']) && isset($_POST['passR']) && !empty($_POST['passR'])){
    
    $name = $_POST['NameR'];
    $pass = password_hash($_POST['passR'], PASSWORD_DEFAULT);
    try{
        //Conectar a la base de datos
        require ('../Config_db/Conexion_db.php');
        require ('../Config_db/Metodos_db.php');
        $database = new connection_db();
        $db = $database->conectar();
        $registro = new Metodos_users($db);
        //Registrar usario en la base de datos
        if($registro->Insert_user($name, $pass)){
            echo 'Usuario correctamente creado' . '<br>';
            $usuarios = $registro->Ver_users();
            print_r($usuarios);
        }else{
            echo '<br>'.'<br>'.'Error al insertar usuario'.'<br>';
            echo "<a href='Registro_FE.html'>Regresar</a>";

        }
    }catch (PDOException $e){
        echo "Error de sentencia: " . $e->getMessage()."<br>";
        echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
        echo "Detalles adicionales:"."<br>";
        print_r($e->errorInfo);
    }
}
