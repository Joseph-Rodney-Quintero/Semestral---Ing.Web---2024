<?php
if(isset($_POST['NameR']) && !empty($_POST['NameR']) && isset($_POST['passR']) && !empty($_POST['passR']) && 
   isset($_POST['NameApe']) && !empty($_POST['NameApe']) && isset($_POST['Ced']) && !empty($_POST['Ced']) && 
   isset($_POST['Correo']) && !empty($_POST['Correo'])){
    
    $name = htmlspecialchars($_POST['NameR']);
    $pass = password_hash($_POST['passR'], PASSWORD_DEFAULT);
    $nombre = htmlspecialchars($_POST['NameApe']);
    $ced = htmlspecialchars($_POST['Ced']);
    $email = filter_var($_POST['Correo'], FILTER_SANITIZE_EMAIL);

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo no válido.");
    }

    // Validar cédula
    /*if (!ctype_digit($ced)) {
        die("La cédula debe ser un número.");
    }*/


    try{
        //Conectar a la base de datos
        require ('../Config_db/Conexion_db.php');
        require ('../Config_db/Metodos_db.php');
        $database = new connection_db();
        $db = $database->conectar();
        $registro = new Metodos_users($db);
        //Registrar usario en la base de datos
        if($registro->Insert_user($name, $pass, $nombre, $ced, $email)){
            echo 'Usuario correctamente creado' . '<br>';
            $usuarios = $registro->Ver_users();
            //print_r($usuarios);
            header('Location: ../Index.php');

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
}else{
    echo "Error de datos insertados"."<br>";
    echo "<a href='Registro_FE.html'>Regresar</a>";
}
