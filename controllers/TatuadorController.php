<?php

require_once "./models/TatuadorModel.php";

class TatuadorController {
    private $tatuadorModel;

    public function __construct() {
        $this->tatuadorModel = new TatuadorModel();
    }

    /**
     * Método para mostrar el formulario de alta de tatuador
     */
    public function showAltaTatuador($errores = []) {
        require_once "./views/tatuadoresViews/AltaTatuadorView.php";
    }

    /**
     * Método para insertar un tatuador en la base de datos
     * @param array $datos
     */
    public function insertTatuador($datos = []) {
        // Extraer datos del formulario
        $input_nombre = trim($datos["input_nombre"] ?? "");
        $input_email = trim($datos["input_email"] ?? "");
        $input_password = trim($datos["input_password"] ?? "");
        $input_foto = $datos["input_foto"] ?? "";

        // Validaciones
        $errores = [];

        if (empty($input_nombre)) {
            $errores["error_nombre"] = "El campo nombre es obligatorio";
        }

        if (empty($input_email) || !filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
            $errores["error_email"] = "Debe ingresar un email válido";
        }

        if (empty($input_password)) {
            $errores["error_password"] = "El campo password es obligatorio";
        }

        // Si hay errores, se vuelve a mostrar el formulario con mensajes
        if (!empty($errores)) {
            $this->showAltaTatuador($errores);
            return;
        }

        // Encriptar la contraseña antes de almacenarla
        $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

        // Insertar en la base de datos
        $operacionExitosa = $this->tatuadorModel->insertTatuador($input_nombre, $input_email, $hashed_password, $input_foto);

        if ($operacionExitosa) {
            // Definir variables para la vista
            $nombre = $input_nombre;
            $email = $input_email;
            $foto = $input_foto;

             // Mostrar la vista de éxito
            require_once "./views/tatuadoresViews/AltaTatuadorCorrectaView.php";
        } else {
            $errores["error_db"] = "Error al insertar el tatuador, intentelo de nuevo más tarde";
            $this->showAltaTatuador($errores);
        }
    }
}

?>
