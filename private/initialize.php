<?php
    ob_start(); // Output Buffering está disponible

    /*
        Una buena práctica de programación en PHP cuándo deseamos reutilizar
        páginas, elementos o secciones, es añadir las rutas de los archivos
        a constantes para evitar errores en navegación de sistema o URL.

        __FILE__ devuelve el directorio actual de este archivo
        dirname() devuelve la ruta al directorio padre

    */

    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PRIVATE_PATH . '/shared');
    define("PARTS_PATH", PRIVATE_PATH . '/parts');

    /*
        Asignamos la URL base (root) a una constante PHP
        - No hay necesidad de incluir el dominio
        - Usamos el mismo documento raíz que el servidor web
        - Podemos establecer algún valor valor códificado (hardcoded value):
            1. define ("WWW_ROOT", "/ ~ allanruiz / CMS / public");
            2. define ("WWW_ROOT", '');
            3. Podemos encontrar dinámicamente toda la URL hasta "/ public"
    */
    
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    require_once('functions.php');
    require_once('database.php');
    require_once('query_functions.php');
    require_once('validation_functions.php');

    $db = db_connect();
    $errors = [];
    $usuarioAutenticado = '';
    
?>