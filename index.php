<?php

    /*
    El archivo más importante en un proyecto MVC es el index.php. Todas las peticiones URL que realice el usuario pasarán por este fichero. 
    Toda acción que se ejecute en nuestra aplicación tendrá que llamar al index y este tendrá que cargar el controlador asociado a dicha acción, 
    el modelo y la vista si procede.

    Responsabilidad principal: Es el punto de entrada de la aplicación.
    Detalles:
    - Se encarga de inicializar el entorno de la aplicación, como configurar constantes, cargar librerías e incluir el archivo de 
    autoloading si se utiliza (por ejemplo, con Composer).
    - Maneja la lógica de enrutar las solicitudes al controlador correspondiente.
    - Es minimalista y delega todas las responsabilidades importantes a las capas lógicas del patrón MVC.
    */
   
    // Cargamos los controladores que necesitamos.
    require_once "./database/DBHandler.php";
    require_once "./controllers/CitaController.php";
    require_once "./controllers/TatuadorController.php";
    require_once "./models/TatuadorModel.php";
    require_once "./models/CitaModel.php";

    // Crear conexión a la base de datos
    $tatuadorModel = new TatuadorModel();
    $citaModel = new CitaModel();

    // Obtener la URL de la petición
    $requestUri = $_SERVER["REQUEST_URI"] ?? "";

    switch ($requestUri) {
        case "/tattooshop_php/citas/alta":
            $citaController = new CitaController();
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            
            if ($requestMethod == "GET") {
                $citaController->showAltaCita();
            } elseif ($requestMethod == "POST") {
                $datos = $_POST ?? [];
                $citaController->insertCita($datos);
            }
            break;
        
        case "/tattooshop_php/tatuadores/alta":
            $tatuadorController = new TatuadorController();
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            
            if ($requestMethod == "GET") {
                $tatuadorController->showAltaTatuador();
            } elseif ($requestMethod == "POST") {
                $datos = $_POST ?? [];
                $tatuadorController->insertTatuador($datos);
            }
            break;
        
        default:
            echo "<h1>PÁGINA NO ENCONTRADA</h1>";
            break;
    }

?>
