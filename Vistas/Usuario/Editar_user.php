<?php
require '../../Session/Session_user.php';
$user_sesion = New User_session();
if(!isset($_SESSION['user'])){
    echo"<script> alert('Debes iniciar sesión');document.location.href = '../Login/Login_Frontend.php';</script>";
    exit();
    //header('Location: ../Login/Login_Frontend.php');   
}
if(isset($_POST['boton0']) && !empty($_POST['boton0'])){
    require '../../Config_db/Conexion_db.php';
    require '../../Config_db/Metodos_db.php';
    $database = new connection_db();
    $db = $database->conectar();
    $metodos = New Metodos_users($db);
    $usuario = $metodos->Buscar_user($_SESSION['user']);

    if(isset($_POST['NameApe']) && !empty($_POST['NameApe'])){
            $nombre = htmlspecialchars($_POST['NameApe']);
            $metodos->Update_User($usuario['id_user'],'name_last',$nombre);
        }
    if(isset($_POST['Ced']) && !empty($_POST['Ced'])){
            $ced = htmlspecialchars($_POST['Ced']);
            $metodos->Update_User($usuario['id_user'],'ced_user',$ced); 
    }
    if(isset($_POST['Correo']) && !empty($_POST['Correo'])){
        $email = filter_var($_POST['Correo'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo"<script> alert('Correo no valido');</script>";
            //die("Correo no válido.");
        }else{
                $metodos->Update_User($usuario['id_user'],'email_user',$email);
        }
    }  
}



    
    
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>

</head>
<body>
    <h3>Editar Datos</h3>
    <form method="post" action="">
        Nombre y apellido: <input type="text" name="NameApe"><br>
        Cedula: <input type="text" name="Ced"><br>
        Correo: <input type="email"  name="Correo"><br><br>
        <input type="submit" name="boton0" value="Enviar"><br><br>
        <a href="../Home.php" target="_blank">Home</a>

    </form>
    
</body>
</html>