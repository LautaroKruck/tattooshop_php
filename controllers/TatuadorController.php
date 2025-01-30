<?php

    require_once "./models/TatuadorModel.php";

    class TatuadorController {

        /*
        ATRIBUTOS DE CLASE.
        En este caso tenemos CitaModel -> Para poder acceder a la Base de Datos
        */
        private $tatuadorModel;

        /*
        CONSTRUCTOR DE CLASE
        El constructor de clase lo utilizamos para inicializar el atributo
        $citaModel. (Recordemos que con Model realizaremos las operaciones CRUD con la Base de Datos)
        */
        public function __construct() {
            $this->tatuadorModel = new TatuadorModel();
        }

        /**
         * Método para mostrar el view de AltaCita -> Contiene la página para dar de alta una cita
         */
        public function showAltaTatuador($errores = []) {
            require_once "./views/tatuadoresViews/AltaTatuadorView.php";
        }

        public function insertTatuador($datos = []) {
            /*
            • id (INT AUTO_INCREMENT) → Identificador único (clave primaria).
            • nombre (VARCHAR 100) → Nombre del tatuador.
            • email (VARCHAR 150) → Correo electrónico único.
            • password (VARCHAR 255) → Contraseña.
            • foto (VARCHAR 255) → URL de la foto de perfil.
            • creado_en (TIMESTAMP DEFAULT CURRENT_TIMESTAMP) → Fecha de
            creación.
            */

            // EXTRAER LOS DATOS DEL FORMULARIO Y ALMACENARLOS EN VARIABLES
            $input_id = $datos["input_id"] ?? "";
            $input_nombre = $datos["input_nombre"] ?? "";
            $input_email = $datos["input_email"] ?? "";
            $input_password = $datos["input_password"] ?? "";
            $input_foto = $datos["input_foto"] ?? "";
            $input_creado_en = $datos["input_creado_en"] ?? "";


            // COMPROBAMOS SI LOS DATOS DEL FORMULARIO SON CORRECTOS -> SI NO VIENEN VACIOS
            $errores = [];
            if($input_id == "" || $input_nombre == "" || $input_email == "" || $input_password == "" || $input_foto == "" ) {
                // COMPROBAMOS QUÉ CAMPO ESTÁ VACÍO Y LO AÑADIMOS A UN ARRAY DE ERRORES
                if($input_id == "") {
                    $errores["error_id"] = "El campo id es obligatorio";
                }

                if($input_nombre == "") {
                    $errores["error_nombre"] = "El campo nombre es obligatorio";
                }

                if($input_email == "") {
                    $errores["error_email"] = "El campo email es obligatorio";
                }

                if($input_password == "") {
                    $errores["error_password"] = "El campo password es obligatorio";
                }

                if($input_foto == "") {
                    $errores["error_foto"] = "El campo foto es obligatorio";
                }

            }

            // SI $errores NO ESTÁ EMPTY, SIGNIFICA QUE HA HABIDO ERRORES
            if(!empty($errores)) {
                $this->showAltaTatuador($errores);
            } else {

                // REGISTRAMOS LA CITA
                // PARA REGISTRAR LA CITA NECESITAMOS ACCEDER A LA BASE DE DATOS -> NECESITAMOS LLAMAR A UN METODO QUE ACCEDA A LA BASE DE DATOS
                // ¿A QUÉ CLASE LLAMAMOS? -> CitaModel.php
                // ¿A QUÉ MÉTODO DE LA CLASE LLAMAMOS? -> insertCita($datosDeLaCita)
                $fecha_cita_formatted = date('Y-m-d H:i:s', strtotime($input_creado_en));
                $operacionExitosa = $this->tatuadorModel->insertTatuador($input_id, $input_nombre, $input_email, $input_password, $input_foto, $input_creado_en);


                if($operacionExitosa) {
                    // LLAMAR A UNA PÁGINA QUE MUESTRE UN MENSAJE DE ÉXITO
                    require_once "./views/tatuadoresViews/AltaTatuadorCorrectaView.php";
                } else {
                    // LLAMAR A ALGÚN SITIO Y MOSTRAR UN MENSAJE DE ERROR
                    $errores["error_db"] = "Error al insertar el tatuador, intentelo de nuevo más tarde";
                    $this->showAltaTatuador($errores);
                }

            }

        }


    }

?>