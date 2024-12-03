<?php
require '../../Session/Session_user.php';
$user_sesion = New User_session();
if(!isset($_SESSION['user'])){
    echo"<script> alert('Debes iniciar sesión');document.location.href = '../Login/Login_Frontend.php';</script>";
    exit();
    //header('Location: ../Login/Login_Frontend.php');   
}

if(isset($_POST['titu']) && !empty($_POST['titu']) && isset($_POST['dire']) && !empty($_POST['dire']) 
  && isset($_POST['inih']) && !empty($_POST['inih']) && isset($_POST['endh']) && !empty($_POST['endh'])
  && isset($_POST['inif']) && !empty($_POST['inif']) && isset($_POST['endf']) && !empty($_POST['endf'])
  && isset($_POST['ede']) && !empty($_POST['ede']) && isset($_POST['ode']) && !empty($_POST['ode']) 
  && isset($_POST['name']) && !empty($_POST['name']) && isset($_FILES['logo']['tmp_name']) 
  && !empty($_FILES['logo']['tmp_name']) && isset($_POST['tipo1']) && !empty($_POST['tipo1'])
  && isset($_POST['qty1']) && !empty($_POST['qty1']) && isset($_POST['precio1']) && !empty($_POST['precio1'])){

    $titu = htmlspecialchars($_POST['titu']);
    $dire = htmlspecialchars($_POST['dire']);
    $inih = $_POST['inih'];
    $endh = $_POST['endh'];
    $inif = $_POST['inif'];
    $endf = $_POST['endf'];
    $ede = htmlspecialchars($_POST['ede']);
    $ode = htmlspecialchars($_POST['ode']);
    $name = htmlspecialchars($_POST['name']);
    $logo =  file_get_contents($_FILES['logo']['tmp_name']);
    //$n_logos = file_get_contents($_FILES['logo']['name']);
    $tipo1 = htmlspecialchars($_POST['tipo1']);
    $qty1 = htmlspecialchars($_POST['qty1']);
    $precio1 = htmlspecialchars($_POST['precio1']);



    
    try{
        require '../../Config_db/Metodos_db.php';
        require '../../Config_db/Eventos_db.php';
        require '../../Config_db/Conexion_db.php';


        $database = new connection_db();
        $db = $database->conectar();
        $Metodos = new Metodos_users($db);
        $Evento = new Eventos_db($db);

        $userSS = $Metodos->Buscar_user($_SESSION['user']);
        $user = $userSS['id_user'];
        //echo $user['id_user'];
        //$user = 2;

        if($Evento->Crear_evento($titu, $dire, $inif, $endf, $inih, $endh, $ede, $ode, $user)){
            $id_evento = $Evento->Ver_idEvent($titu, $user);
            if($Evento->Crear_logo($id_evento, $name, $logo)){
                if($Evento->Crear_tickets($tipo1, $id_evento, $qty1, $precio1)){
                    if(isset($_POST['tipo2']) && !empty($_POST['tipo2']) && isset($_POST['qty2']) && !empty($_POST['qty2']) 
                       && isset($_POST['precio2']) && !empty($_POST['precio2'])){
                        $tipo = htmlspecialchars($_POST['tipo2']);
                        $qty = htmlspecialchars($_POST['qty2']);
                        $precio = htmlspecialchars($_POST['precio2']);
                        $Evento->Crear_tickets($tipo, $id_evento, $qty, $precio);
                        echo '<br>'.'Exito total';
                    }
                    if(isset($_POST['tipo3']) && !empty($_POST['tipo3']) && isset($_POST['qty3']) && !empty($_POST['qty3']) 
                       && isset($_POST['precio3']) && !empty($_POST['precio3'])){
                        $tipo = htmlspecialchars($_POST['tipo3']);
                        $qty = htmlspecialchars($_POST['qty3']);
                        $precio = htmlspecialchars($_POST['precio3']);
                        $Evento->Crear_tickets($tipo, $id_evento, $qty, $precio);
                        echo '<br>'.'Exito total';
                    }
                    if(isset($_POST['tipo4']) && !empty($_POST['tipo4']) && isset($_POST['qty4']) && !empty($_POST['qty4']) 
                       && isset($_POST['precio4']) && !empty($_POST['precio4'])){
                        $tipo = htmlspecialchars($_POST['tipo4']);
                        $qty = htmlspecialchars($_POST['qty4']);
                        $precio = htmlspecialchars($_POST['precio4']);
                        $Evento->Crear_tickets($tipo, $id_evento, $qty, $precio);
                        echo '<br>'.'Exito total';
                    }
                    if(isset($_POST['tipo5']) && !empty($_POST['tipo5']) && isset($_POST['qty5']) && !empty($_POST['qty5']) 
                       && isset($_POST['precio5']) && !empty($_POST['precio5'])){
                        $tipo = htmlspecialchars($_POST['tipo5']);
                        $qty = htmlspecialchars($_POST['qty5']);
                        $precio = htmlspecialchars($_POST['precio5']);
                        $Evento->Crear_tickets($tipo, $id_evento, $qty, $precio);
                        echo '<br>'.'Exito total';
                    }
                    
                    echo '<br>'.'Exito total';
                    echo"<script> alert('Evento creado');document.location.href = '../Home.php';</script>";

                }
            }
        }

    }catch(PDOException $e){
        echo "Error de sentencia: " . $e->getMessage()."<br>";
        echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
        echo "Detalles adicionales:"."<br>";
        print_r($e->errorInfo);
    }

    echo "Paso";

    

   

}else{
    echo "Error de insercion";
}


