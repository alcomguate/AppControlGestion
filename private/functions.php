<?php
    function url_for($script_path){
        // Agregamos el '/' si no está presente
        if ($script_path[0]!='/') {
            $script_path = "/" . $script_path;
        }
        return WWW_ROOT . $script_path;
    }

    function u($string=""){
        return urlencode($string);
    }

    function raw_u($string=""){
        return rawurlencode($string);
    }

    function h($string=""){
        return htmlspecialchars($string);
    }

    function error_404(){
       header($_SERVER["SERVER_PROTOCOL"] . " 404 Not found");
       exit();
    }

    function error_500(){
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Protocol");
        exit();
    }

    function redirect_to($location){
        header("Location: " . $location);
        exit();
    }

    function is_post_request(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function is_get_request(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    function display_errors($errors=array()){
        $output = '';

        if (!empty($errors)) {
            $output .= "<div class=\"alert alert-danger\" role=\"alert\">";
            $output .= "<h4 class=\"alert-heading\">Corrige los siguientes errores:</h4>";
            $output .= "<hr>";
            $output .= "<dl>";
                foreach ($errors as $error) {
                   $output .= "<dd>" . h($error) . "</dd>";
                }
            $output .= "</dl>";
            $output .= "</div>";
        } 
        return $output;
    }
?>