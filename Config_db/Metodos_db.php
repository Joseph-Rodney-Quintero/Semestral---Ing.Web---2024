<?php
class Metodos_users{
    private $db_conn;
    private $table_name = "usuario";
    private $rol = 1;

    // Constructor que recibe la conexión
    public function __construct($db){
        $this->db_conn = $db;
    }
    
    //Metodo para Insertar usuarios
    public function Insert_user($name,$pass,$name_last,$ced,$email){
        if($this->Verificar_user($name)){
            echo '<br>'.'Usuario ya existe';
            return false;
        }
        try{
            $query = "INSERT INTO " . $this->table_name . "(name_user, pass_user, id_rol, name_last, ced_user, email_user) VALUES (:name, :pass, :rol, :name_last, :ced, :email)";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":pass", $pass);
            $stmt->bindParam(":rol", $this->rol);
            $stmt->bindParam(":name_last", $name_last);
            $stmt->bindParam(":ced", $ced);
            $stmt->bindParam(":email", $email);
            $result = $stmt->execute();
           // echo 'Usuario correctamente creado';
            return $result;
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
            return false;
        }  
    }

    //Metodo para leer todos los usuarios
    public function Ver_users() {
        try{
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->db_conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }
        
    }

    //Metodo para Verificar usuario existente
    public function Verificar_user($name){
        try{
            $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE name_user = :name";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":name", $name);
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

    public function Buscar_user($user){
        try{
            $query = "SELECT * FROM " . $this->table_name . " WHERE name_user = :user";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":user", $user);
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

    public function Login($user, $pass){
        if($this->Verificar_user($user)){
            try{
                $query = "SELECT pass_user FROM " . $this->table_name . " WHERE name_user = :user";
                $stmt = $this->db_conn->prepare($query);
                $stmt->bindParam(":user", $user);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $hash = $resultado['pass_user'];
                if(password_verify($pass, $hash)){
                    return true;
                    //echo '<br>'."Bienvenido";
                }else{
                    return false;
                    //echo '<br>'."Password incorrect";
                }

            }catch(PDOException $e){
                echo "Error de sentencia: " . $e->getMessage()."<br>";
                echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
                echo "Detalles adicionales:"."<br>";
                print_r($e->errorInfo);
            }
        }else{
            return false;
            //echo '<br>'.'Usuario no encontrado';
        }
    }

    public function Update_User($id, $column, $dato) {
        try{
            //$query = "UPDATE " . $this->table_name . " SET name_last = :nombre, email_user = :email,  WHERE id = :id";
            $query = "UPDATE " . $this->table_name . " SET " .$column. " = :dato WHERE id_user = :id";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":dato", $dato);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
        }
    }

    /*public function Update_User2($id, $nombre, $email) {
        //$query = "UPDATE " . $this->table_name . " SET name_last = :nombre, email_user = :email,  WHERE id = :id";
        $query = "UPDATE " . $this->table_name . " SET " .name_last. = :nombre " WHERE id = :id";
        $stmt = $this->db_conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        return $stmt->execute();*/

}





/*$database = new connection_db();
$db = $database->conectar();
$registro = new Crud_user($db);
$registro->Insert_user('Tony','12345');*/

//$conexion = conectar_db();


