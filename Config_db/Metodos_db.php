<?php
class Metodos_users{
    private $db_conn;
    private $table_name = "usuario";

    // Constructor que recibe la conexión
    public function __construct($db){
        $this->db_conn = $db;
    }
    
    //Metodo para Insertar usuarios
    public function Insert_user($name,$pass){
        if($this->Verificar_user($name)){
            echo '<br>'.'Usuario ya existe';
            return false;
        }
        try{
            
            $query = "INSERT INTO " . $this->table_name . "(name_user, pass_user) VALUES (:name, :pass)";
            $stmt = $this->db_conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":pass", $pass);
           // echo 'Usuario correctamente creado';
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Error de sentencia: " . $e->getMessage()."<br>";
            echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
            echo "Detalles adicionales:"."<br>";
            print_r($e->errorInfo);
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
            $query = "SELECT COUNT(*) FROM usuario WHERE name_user = :name";
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

    public function Login($user, $pass){
        if($this->Verificar_user($user)){
            try{
                $query = "SELECT pass_user FROM usuario WHERE name_user = :user";
                $stmt = $this->db_conn->prepare($query);
                $stmt->bindParam(":user", $user);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $hash = $resultado['pass_user'];
                if(password_verify($pass, $hash)){
                    echo '<br>'."Bienvenido";
                }else{
                    echo '<br>'."Password incorrect";
                }

            }catch(PDOException $e){
                echo "Error de sentencia: " . $e->getMessage()."<br>";
                echo "Código de error SQLSTATE: " . $e->getCode()."<br>";
                echo "Detalles adicionales:"."<br>";
                print_r($e->errorInfo);
            }
        }else{
            echo '<br>'.'Usuario no encontrado';
        }
    }

}





/*$database = new connection_db();
$db = $database->conectar();
$registro = new Crud_user($db);
$registro->Insert_user('Tony','12345');*/

//$conexion = conectar_db();


