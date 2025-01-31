<?php

require_once "./database/DBHandler.php";

class TatuadorModel {
    private $nombreTabla = "tatuadores"; 
    private $conexion;              
    private $dbHandler;             

    public function __construct() {
        $this->dbHandler = new DBHandler("localhost", "root", "", "tattooshop_bd", "3306");
    }

    /**
     * MÉTODO PARA INSERTAR UN TATUADOR EN LA BASE DE DATOS
     * @param string $nombre
     * @param string $email
     * @param string $password
     * @param string $foto
     * @return bool
     */
    public function insertTatuador($nombre, $email, $password, $foto) {
        // Encriptar la contraseña antes de guardarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Conectar a la base de datos
        $this->conexion = $this->dbHandler->conectar();

        // Verificar si el email ya existe
        $checkSql = "SELECT id FROM $this->nombreTabla WHERE email = ?";
        $checkStmt = $this->conexion->prepare($checkSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            return false; // El email ya está registrado
        }
        $checkStmt->close();

        // Query de inserción sin ID ni creado_en (se generan automáticamente)
        $sql = "INSERT INTO $this->nombreTabla (nombre, email, password, foto) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $hashedPassword, $foto);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        } finally {
            $stmt->close();
            $this->dbHandler->desconectar();
        }
    }
    public function getAllTatuadores() {
        $this->conexion = $this->dbHandler->conectar();
        $sql = "SELECT id, nombre FROM $this->nombreTabla";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $tatuadores = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $this->dbHandler->desconectar();
        return $tatuadores;
    }

    public function getTatuadorById($id) {
        $this->conexion = $this->dbHandler->conectar();
        
        $sql = "SELECT nombre, email, foto FROM tatuadores WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $tatuador = $resultado->fetch_assoc();
        
        $stmt->close();
        $this->dbHandler->desconectar();
        
        return $tatuador;
    } 
}

?>
