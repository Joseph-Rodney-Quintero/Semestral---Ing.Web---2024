<?php
require '../Session/Session_user.php';
//require '../Config_db/Conexion_db.php';
require '../Config_db/Eventos_db.php';
$user_sesion = New User_session();
if(isset($_SESSION['user'])){
    $user = $user_sesion->Obtener_user($_SESSION['user']);
      
}else{
    echo"<script> alert('Debes iniciar sesión');document.location.href = '../Login/Login_Frontend.php';</script>";
    //header('Location: ../Login/Login_Frontend.php'); 
}
$database2 = new connection_db();
$db2 = $database2->conectar();
$event = new Eventos_db($db2);
$eventos = $event->imprimir_evento();
$filas = count($eventos);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Usuario</title>
</head>
<body>
    <h3>Bienvenido <?php echo $user;  ?></h3><br>

    <h4>Menu</h4>
    <a href="Usuario/Mi_Cuenta.php">Mi Cuenta</a><br>
    <a href="Evento/CrearEvento_Frontend.php">Crear Evento</a><br>
    <a href="Cerrar_session.php">Cerrar Sesion</a><br>

    <h4>Eventos</h4>

    <table>
        <tr>  
            <?php for($x=0;$x<$filas;$x++){ $id=$eventos[$x]['id_event'];?>
                <td>
                    <a href="Evento/ver_evento.php?id=<?php echo $id ?>">
                        <?php 
                            $image = $event->imprimir_image($id);
                            $image_base64 = base64_encode($image['imagen']);
                            echo "<img src='data:image/jpeg;base64,{$image_base64}' alt='Imagen' width='200' height='150'>".'<br>';
                             //echo $image['imagen'];
                            echo($eventos[$x]['tittle_event']).'<br>';
                            echo($eventos[$x]['direccion']).'<br>';
                            echo($eventos[$x]['fecha_start']).'<br>';
                            echo($eventos[$x]['fecha_end']).'<br>';
                            echo($eventos[$x]['hora_start']).'<br>';
                            echo($eventos[$x]['hora_end']).'<br>';
                        ?>                   
                    </a>                    
                </td> 
            <?php }?>     
        </tr>
        
    </table>

   



    
    
    
</body>
</html>