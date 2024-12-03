<?php

class Eventos_db{

    private $db_conn;
    private $table_user = "usuario";
    private $table_eventos = "eventos";
    private $table_tickets = "ticket_event";
    private $table_factura = "factura_event";
    private $table_image = "image_event";


    public function __construct($db){
        $this->db_conn = $db;
    }

    public function Crear_evento($titulo, $lugar, $f_start, $f_end, $h_start, $h_end, $d_event, $d_org, $id_user){
        if($this->Verificar_TituloDisponible($titulo)){
            echo '<br>'.'Usuario ya existe';
            return false;
        }
        try{
            $query = "INSERT INTO ".$this->table_eventos." (tittle_event, direccion, fecha_start, fecha_end, hora_start, hora_end, Desc_event, Desc_org, id_user) VALUES (:titulo, :lugar, :f_start, :f_end, :h_start, :h_end, :d_event, :d_org, :id_user)";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":lugar", $lugar);
            $stmt->bindParam(":f_start", $f_start);
            $stmt->bindParam(":f_end", $f_end);
            $stmt->bindParam(":h_start", $h_start);
            $stmt->bindParam(":h_end", $h_end);
            $stmt->bindParam(":d_event", $d_event);
            $stmt->bindParam(":d_org", $d_org);
            $stmt->bindParam(":id_user", $id_user);
            $result = $stmt->execute();
            echo 'Parte 1 de evento correctamente creado'.'<br>';
            return $result;

        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
            return false;
        }  

    }

    public function Crear_tickets($tipo, $id_event, $qty, $price){
        try{
            $query = "INSERT INTO ".$this->table_tickets." (tipo_ticket, id_event, qty_ticket, precio) VALUES (:tipo, :id, :qty, :price)";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":tipo", $tipo);
            $stmt->bindParam(":id", $id_event);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":price", $price);
            $result = $stmt->execute();
            echo 'Parte 3 de evento correctamente creado'.'<br>';
            return $result;

        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
            return false;
        }  

    }

    public function Crear_logo($id_event ,$titulo, $image){
        try{
            $query = "INSERT INTO ".$this->table_image." (id_event, name_image, imagen) VALUES (:id_event, :titulo, :image)";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":id_event", $id_event);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":image", $image, PDO::PARAM_LOB);
            $result = $stmt->execute();
            echo 'Parte 2 de evento correctamente creado'.'<br>';
            return $result;
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
            return false;
        }

    }

    public function Ver_idEvent($titulo, $id_user){
        try{
            $query = "SELECT * FROM " . $this->table_eventos . " WHERE tittle_event = :titulo AND id_user = :id_user";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['id_event'];   
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }

    }

    public function Verificar_TituloDisponible($titulo){
        try{
            $query = "SELECT COUNT(*) FROM " . $this->table_eventos . " WHERE tittle_event = :titulo";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;   
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }

    }

    public function imprimir_evento(){
        try{
            $query = "SELECT * FROM " . $this->table_eventos;
            $stmt = $this->db_conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;

            }    
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }

    }

    public function imprimir_image($id){
        try{
            $query = "SELECT imagen FROM " . $this->table_image ." WHERE id_event = :id";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }

    }

    

    public function imprimir_tickets($id){
        try{
            $query = "SELECT * FROM " . $this->table_tickets ." WHERE id_event = :id";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":id", $id,PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return false;

            } 
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }

    }

    

    public function buscar_evento($id){
        try{
            $query = "SELECT * FROM " . $this->table_eventos ." WHERE id_event = :id";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }

    }


    public function Comprar_ticket($id_user, $id_event, $id_ticket, $qty, $price){
        try{
            $query = "INSERT INTO ".$this->table_factura." (id_user, id_event, id_ticket, qty_ticket, Total_pago) VALUES (:user, :event, :ticket, :qty, :price)";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":user", $id_user);
            $stmt->bindParam(":event", $id_event);
            $stmt->bindParam(":ticket", $id_ticket);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":price", $price);
            $result = $stmt->execute();
            //echo ''.'<br>';
            return $result;
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
            return false;
        }

    }

    public function cambiar_tickets(){

    }

    public function rembolsar_tickets(){

    }
    

}