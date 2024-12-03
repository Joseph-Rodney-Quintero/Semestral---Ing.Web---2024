<?php
require '../../Session/Session_user.php';
$user_sesion = New User_session();
if(!isset($_SESSION['user'])){
    echo"<script> alert('Debes iniciar sesión');document.location.href = '../Login/Login_Frontend.php';</script>";
    exit();
    //header('Location: ../Login/Login_Frontend.php');   
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    
    require '../../Config_db/Conexion_db.php';
    require '../../Config_db/Metodos_db.php';
    require '../../Config_db/Eventos_db.php';
    
    $database = new connection_db();
    $db = $database->conectar();
    $metodos = new Metodos_users($db);
    $event = new Eventos_db($db);
    $evento = $event->buscar_evento($id);
    $tickets = $event->imprimir_tickets($id);
    $fila = count($tickets);
    
    
    //$evento = $metodos->Obtener_evento_por_id($id_evento);
    
    if ($evento) {
        //detalles del evento
        echo '<h1>' . $evento['tittle_event'] . '</h1>';
        echo '<p>' . $evento['direccion'] . '</p>';
        echo '<p>Fecha inicio: ' . $evento['fecha_start'] . '</p>';
        echo '<p>Fecha fin: ' . $evento['fecha_end'] . '</p>';
        echo '<p>Hora inicio: ' . $evento['hora_start'] . '</p>';
        echo '<p>Hora fin: ' . $evento['hora_end'] . '</p>';
        echo '<p>Descripcion de evento: ' . $evento['Desc_event'] . '</p>';
        echo '<p>Descripcion de organizador: ' . $evento['Desc_org'] . '</p>';
        
        //print_r($evento);

    } else {
        echo 'Evento no encontrado.';
    }
} else {
    echo 'No se seleccionó ningún evento.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento</title>
</head>
<body>
    <h3>Evento</h3>
    <form method="post" action="">
        <?php 
            for($x=0;$x<$fila;$x++){
                echo 'Ticket: '.$tickets[$x]['tipo_ticket'].' |---| '.'Tickets disponibles: '.$tickets[$x]['qty_ticket'].' |---| '.'Precio por ticket: $'.$tickets[$x]['precio'].' |---> ';?>
                <input type="number" name="qty<?php echo $x; ?>" min="0" step="1" placeholder="Cantidad a comprar"><br><br>
           
           <?php }?>
        <br><br><input type="submit" name="boton0" value="Enviar"><br><br>
        <a href="../Home.php">Home</a>



    </form>
</body>
</html>

<?php 
if(isset($_POST['boton0'])){
    if(isset($_POST['qty0']) && !empty($_POST['qty0'])){
        $qty = $_POST['qty0'];
        $qty_dis = $tickets[0]['id_ticket'];
        $res = $qty_dis - $qty;
        $price = $qty * $tickets[0]['precio'];
        if($res < 0){
            echo"<script> alert('Tickets no disponibles');document.location.href = '../Home.php';</script>";
        }else {
            $id_user = $metodos->Buscar_user($_SESSION['user']);
            if($event->Comprar_ticket($id_user['id_user'], $tickets[0]['id_event'], $tickets[0]['id_ticket'],$qty, $price)){
                echo"<script> alert('Compra realizada');document.location.href = '../Home.php';</script>";

            }else{
                 echo"<script> alert('Error de comprar');document.location.href = 'Ver_evento.php';</script>";
            }
        }

    }
    if(isset($_POST['qty1']) && !empty($_POST['qty1'])){
        $qty = $_POST['qty1'];
        $qty_dis = $tickets[1]['id_ticket'];
        $res = $qty_dis - $qty;
        $price = $qty * $tickets[1]['precio'];
        if($res < 0){
            echo"<script> alert('Tickets no disponibles');document.location.href = '../Home.php';</script>";
        }else {
            $id_user = $metodos->Buscar_user($_SESSION['user']);
            if($event->Comprar_ticket($id_user['id_user'], $tickets[1]['id_event'], $tickets[1]['id_ticket'],$qty, $price)){
                echo"<script> alert('Compra realizada');document.location.href = '../Home.php';</script>";

            }else{
                echo"<script> alert('Error de comprar');document.location.href = 'Ver_evento.php';</script>";
            }
        }
    }
    if(isset($_POST['qty2']) && !empty($_POST['qty2'])){
        $qty = $_POST['qty2'];
        $qty_dis = $tickets[2]['id_ticket'];
        $res = $qty_dis - $qty;
        $price = $qty * $tickets[2]['precio'];
        if($res < 0){
            echo"<script> alert('Tickets no disponibles');document.location.href = '../Home.php';</script>";
        }else {
            $id_user = $metodos->Buscar_user($_SESSION['user']);
            if($event->Comprar_ticket($id_user['id_user'], $tickets[2]['id_event'], $tickets[2]['id_ticket'],$qty, $price)){
                echo"<script> alert('Compra realizada');document.location.href = '../Home.php';</script>";

            }else{
                echo"<script> alert('Error de comprar');document.location.href = 'Ver_evento.php';</script>";
            }
        }
        
    }
    if(isset($_POST['qty3']) && !empty($_POST['qty3'])){
        $qty = $_POST['qty3'];
        $qty_dis = $tickets[3]['id_ticket'];
        $res = $qty_dis - $qty;
        $price = $qty * $tickets[3]['precio'];
        if($res < 0){
            echo"<script> alert('Tickets no disponibles');document.location.href = '../Home.php';</script>";
        }else {
            $id_user = $metodos->Buscar_user($_SESSION['user']);
            if($event->Comprar_ticket($id_user['id_user'], $tickets[3]['id_event'], $tickets[3]['id_ticket'],$qty, $price)){
                echo"<script> alert('Compra realizada');document.location.href = '../Home.php';</script>";

            }else{
                echo"<script> alert('Error de comprar');document.location.href = 'Ver_evento.php';</script>";
            }
        }
        
    }
    if(isset($_POST['qty4']) && !empty($_POST['qty4'])){
        $qty = $_POST['qty4'];
        $qty_dis = $tickets[4]['id_ticket'];
        $res = $qty_dis - $qty;
        $price = $qty * $tickets[4]['precio'];
        if($res < 0){
            echo "Tickets no disponibles";
        }else {
            $id_user = $metodos->Buscar_user($_SESSION['user']);
            if($event->Comprar_ticket($id_user['id_user'], $tickets[4]['id_event'], $tickets[4]['id_ticket'],$qty, $price)){
                echo 'Insercion correcta';

            }else{
                echo 'error';
            }
        }
        
    }

}
?>