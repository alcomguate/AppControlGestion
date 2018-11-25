<?php
    require_once('credentials.php');

    function db_connect(){
        $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME,DB_PORT);
        confirm_db_connect();
        return $connection;
    }

    function db_disconnect($connection){
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }

    function confirm_db_connect(){
        if(mysqli_connect_errno()){
			$msg = "No se pudo realizar conexión con la base de datos. ";
			$msg .= mysqli_connect_error();
            $msg .= " ( " . mysqli_connect_errno() . ")";
            exit($msg);
		}
    }

    function confirm_result_set($result_set){
        if(!$result_set){
			exit("No se pudo realizar la consulta a la base de datos.");
		}
    }

    function db_escape($connection,$string){
        return mysqli_real_escape_string($connection,$string);
    }
?>

