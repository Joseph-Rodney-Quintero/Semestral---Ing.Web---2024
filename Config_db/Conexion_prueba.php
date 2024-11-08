<?php
 class Database {
     private $host = "localhost";      // Cambia esto por el host de tu base de datos
     private $db_name = "mi_base_de_datos"; // Nombre de la base de datos
     private $username = "root";       // Usuario de la base de datos
     private $password = "";           // Contraseña de la base de datos
     private $conn;
 
     // Método para conectarse a la base de datos
     public function connect() {
         $this->conn = null;
         try {
             $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch(PDOException $exception) {
             echo "Error de conexión: " . $exception->getMessage();
         }
         return $this->conn;
     }
 }
 
 class Usuario {
     private $conn;
     private $table = "usuarios";
 
     // Constructor que recibe la conexión
     public function __construct($db) {
         $this->conn = $db;
     }
 
     // Método para crear un nuevo usuario
     public function crearUsuario($nombre, $email) {
         $query = "INSERT INTO " . $this->table . " (nombre, email) VALUES (:nombre, :email)";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":nombre", $nombre);
         $stmt->bindParam(":email", $email);
         return $stmt->execute();
     }
 
     // Método para leer todos los usuarios
     public function leerUsuarios() {
         $query = "SELECT * FROM " . $this->table;
         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
 
     // Método para actualizar un usuario por su ID
     public function actualizarUsuario($id, $nombre, $email) {
         $query = "UPDATE " . $this->table . " SET nombre = :nombre, email = :email WHERE id = :id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":id", $id);
         $stmt->bindParam(":nombre", $nombre);
         $stmt->bindParam(":email", $email);
         return $stmt->execute();
     }
 
     // Método para eliminar un usuario por su ID
     public function eliminarUsuario($id) {
         $query = "DELETE FROM " . $this->table . " WHERE id = :id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":id", $id);
         return $stmt->execute();
     }
 }
 
 // Uso de la clase
 $database = new Database();
 $db = $database->connect();
 
 $usuario = new Usuario($db);
 
 // Crear un nuevo usuario
 $usuario->crearUsuario("Juan Perez", "juan@example.com");
 
 // Leer todos los usuarios
 $usuarios = $usuario->leerUsuarios();
 print_r($usuarios);
 
 // Actualizar un usuario
 $usuario->actualizarUsuario(1, "Juan P. Perez", "juanp@example.com");
 
 // Eliminar un usuario
 $usuario->eliminarUsuario(1);
 ?>
   