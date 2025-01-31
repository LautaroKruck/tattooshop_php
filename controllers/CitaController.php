<?php

require_once "./models/CitaModel.php";
require_once "./models/TatuadorModel.php";

class CitaController {
    private $citaModel;
    private $tatuadorModel;

    public function __construct() {
        $this->tatuadorModel = new TatuadorModel();
        $this->citaModel = new CitaModel(); // Pasamos la conexión a la BD
    }

    public function showAltaCita($errores = []) {
        $tatuadores = $this->tatuadorModel->getAllTatuadores();
        require_once "./views/citasViews/AltaCitaView.php";
    }

    public function insertCita($datos = []) {
        $input_descripcion = trim($datos["input_descripcion"] ?? "");
        $input_fecha_cita = trim($datos["input_fecha_cita"] ?? "");
        $input_cliente = trim($datos["input_cliente"] ?? "");
        $input_tatuador = $datos["input_tatuador"] ?? "";
    
        $errores = [];
    
        // Validaciones de campos vacíos
        if (empty($input_descripcion)) {
            $errores["error_descripcion"] = "El campo descripción es obligatorio.";
        }
        if (empty($input_fecha_cita)) {
            $errores["error_fechaCita"] = "La fecha de la cita es obligatoria.";
        } else {
            // Validar que la fecha no sea en el pasado
            $fecha_actual = date('Y-m-d H:i:s');
            $fecha_cita_formatted = date('Y-m-d H:i:s', strtotime($input_fecha_cita));
    
            if ($fecha_cita_formatted < $fecha_actual) {
                $errores["error_fechaCita"] = "La fecha de la cita no puede ser en el pasado.";
            }
        }
        if (empty($input_cliente)) {
            $errores["error_cliente"] = "El campo cliente es obligatorio.";
        }
        if (empty($input_tatuador) || !is_numeric($input_tatuador)) {
            $errores["error_tatuador"] = "Debe seleccionar un tatuador válido.";
        }
    
        // Si hay errores, se vuelve a mostrar el formulario con mensajes
        if (!empty($errores)) {
            $this->showAltaCita($errores);
            return;
        }
    
        // Insertar la cita en la base de datos
        $operacionExitosa = $this->citaModel->insertCita($input_descripcion, $fecha_cita_formatted, $input_cliente, $input_tatuador);
    
        if ($operacionExitosa) {
            // Recuperar datos del tatuador para mostrar en la vista de éxito
            $tatuador = $this->tatuadorModel->getTatuadorById($input_tatuador);
    
            // Definir variables para la vista
            $descripcion = $input_descripcion;
            $fecha_cita = $fecha_cita_formatted;
            $cliente = $input_cliente;
            $tatuador_nombre = $tatuador["nombre"] ?? "Desconocido";
            $tatuador_email = $tatuador["email"] ?? "Desconocido";
            $tatuador_foto = $tatuador["foto"] ?? "/public/images/default.jpg";
    
            // Mostrar la vista de éxito
            require_once "./views/citasViews/AltaCitaCorrectaView.php";
        } else {
            $errores["error_db"] = "Error al insertar la cita, intente de nuevo más tarde.";
            $this->showAltaCita($errores);
        }
    }
}

?>
