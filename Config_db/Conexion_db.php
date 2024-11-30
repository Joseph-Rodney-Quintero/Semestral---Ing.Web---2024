<?php
class connection_db{
    private $db_name = "ing. web - semestral2024"; // nombre de la base de datos
    private $db_host = "localhost"; // nombre del servidor
    private $db_pass = ""; // contraseña
    private $db_user = "root"; // usuario
    private $conn; //Nombre de objeto PDO

    public function conectar(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa a la base de datos"."<br>";
            $hostInfo = $this->conn->getAttribute(PDO::ATTR_SERVER_INFO);
            //echo "Información del host: " . $hostInfo . "<br>";
            $serverVersion = $this->conn->getAttribute(PDO::ATTR_SERVER_VERSION);
            //echo "Versión del servidor MySQL: " . $serverVersion . "<br>";
            return $this->conn;
        }catch(PDOException $e){
            print "Error de conexión: " . $e->getMessage();
        }
    }
}