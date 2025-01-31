<?php

require_once "./database/DBHandler.php";

class CitaModel {
    private $nombreTabla = "citas"; 
    private $conexion;              
    private $dbHandler;             

    public function __construct() {
        $this->dbHandler = new DBHandler("localhost", "root", "", "tattooshop_bd", "3306");
    }

    /**
     * MÉTODO PARA INSERTAR UNA CITA EN LA BASE DE DATOS
     * @param string $descripcion
     * @param string $fechaCita
     * @param string $cliente
     * @param int $tatuador
     * @return bool
     */
    public function insertCita($descripcion, $fechaCita, $cliente, $tatuador) {
        // Conectar a la base de datos
        $this->conexion = $this->dbHandler->conectar();

        // Verificar si el tatuador existe antes de registrar la cita
        $checkSql = "SELECT id FROM tatuadores WHERE id = ?";
        $checkStmt = $this->conexion->prepare($checkSql);
        $checkStmt->bind_param("i", $tatuador);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows == 0) {
            return false; // El tatuador no existe
        }
        $checkStmt->close();

        // Query de inserción sin ID (se genera automáticamente)
        $sql = "INSERT INTO $this->nombreTabla (descripcion, fecha_cita, cliente, tatuador) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", $descripcion, $fechaCita, $cliente, $tatuador);

        try {
            return $stmt->execute(); // Ejecutar la consulta de inserción
        } catch (Exception $e) {
            return false; // Si hay error, retornar falso
        } finally {
            $stmt->close();
            $this->dbHandler->desconectar();
        }
    }
}

?>
