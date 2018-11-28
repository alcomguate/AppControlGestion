<?php

    // Obteniendo todas las organizaciones
    function get_all_organization($options=[]) {
        global $db;

        $activo = $options['activo'];
        
        $query = "SELECT * FROM Organizacion ";

        if ($activo) {
            $query .= "WHERE activo = true";
        }

        $result_set = mysqli_query($db, $query);
        confirm_result_set($result_set);
        return $result_set;
    }

    // Obteniendo todas las categorias
    function get_all_category($options=[]) {
        global $db;

        $activo = $options['activo'];
        
        $query = "SELECT * FROM Categoria ";

        if ($activo) {
            $query .= "WHERE activo = true";
        }

        $result_set = mysqli_query($db, $query);
        confirm_result_set($result_set);
        return $result_set;
    }

    // Validacion de usuario
    function validate_login($credenciales=[]) {
        global $db;

        $nombre_usuario = $credenciales['usuario'];
        $contrasena = $credenciales['password'];

        $query = "SELECT * FROM Usuario ";
        $query .= "WHERE nombre_usuario = '" . db_escape($db, $nombre_usuario);
        $query .= "' AND contrasena = '" . db_escape($db, $contrasena) . "' LIMIT 1";

        $result_set = mysqli_query($db, $query);
        confirm_result_set($result_set);
        $resultado = mysqli_fetch_assoc($result_set);
        mysqli_free_result($result_set);
        return $resultado;
    }

    // obtener permisos del usuario
    function get_usertype_by_userid($user_id) {
        global $db;

        $query = "SELECT TU.* FROM Usuario U ";
        $query .= "INNER JOIN Tipo_usuario TU ";
        $query .= "ON TU.id = U.tipo_usuario ";
        $query .= "WHERE U.id = " . db_escape($db, $user_id) . " LIMIT 1";

        $result_set = mysqli_query($db, $query);
        confirm_result_set($result_set);
        $resultado = mysqli_fetch_assoc($result_set);
        mysqli_free_result($result_set);
        return $resultado;
    }

    // CRUD Gestion
    function insert_gestion($gestion) {
        global $db;

        $errors = validate_gestion($gestion);
        if (!empty($errors)) {
            return $errors;
        }

        $query = "INSERT INTO Gestion ";
        $query .= "(titulo, descripcion, fecha_emision, estado, usuario_solicita, categoria) ";
        $query .= "VALUES(";
        $query .= "'" . db_escape($db,$gestion['titulo']) . "',";
        $query .= "'" . db_escape($db,$gestion['descripcion']) . "',";
        $query .= "SYSDATE(), 1,";
        $query .= "'" . db_escape($db,$gestion['usuario_solicita']) . "',";
        $query .= "'" . db_escape($db,$gestion['categoria']) . "')";

        error_log($query);

        $result_set = mysqli_query($db,$query);

        if ($result_set) {
            return true;
        }else{
            // echo mysql_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function validate_gestion($gestion) {
        $errors = [];
        
        if(is_blank($gestion['titulo'])) {
          $errors[] = "Título no puede estar en blanco.";
        }elseif(!has_length($gestion['titulo'], ['min' => 2, 'max' => 100])) {
          $errors[] = "Título debe contener entre 2 y 100 caracteres.";
        }
      
        if(is_blank($gestion['descripcion'])) {
            $errors[] = "Descripción no puede estar en blanco.";
        } elseif(!has_length($gestion['descripcion'], ['min' => 2, 'max' => 1000])) {
            $errors[] = "Descripción debe contener entre 2 y 1000 caracteres.";
        }

        return $errors;
    }

    // CRUD Subjects
    function find_all_subjects($options=[]) {
        global $db;

        $visible = $options['visible'] ?? false;

        $query = "SELECT * FROM subjects ";

        if ($visble) {
            $query .= "WHERE visible = true ";
        }
        $query .= "ORDER BY position ASC";
        $result_set = mysqli_query($db,$query);
        confirm_result_set($result_set);
        return $result_set;
    }

    function find_subject_by_id($id){
        global $db;

        $query = "SELECT * FROM subjects ";
        $query .= "WHERE id='" . db_escape($db,$id) . "'";
        $result_set = mysqli_query($db,$query);
        confirm_result_set($result_set);
        $subject = mysqli_fetch_assoc($result_set);
        mysqli_free_result($result_set);
        return $subject; // return como un arreglo asociativo
    }

    function validate_subject($subject) {
        $errors = [];
        // menu_name
        if(is_blank($subject['menu_name'])) {
          $errors[] = "Nombre no puede estar en blanco.";
        }elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Nombre debe contener entre 2 y 255 caracteres.";
        }
      
        // position
        $postion_int = (int) $subject['position'];
        if($postion_int <= 0) {
          $errors[] = "Posición debe ser mayor a 0.";
        }
        if($postion_int > 999) {
          $errors[] = "Position debe ser menor que 999.";
        }
      
        // visible
        $visible_str = (string) $subject['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
          $errors[] = "Visible debe ser sí o no.";
        }
        return $errors;
    }

    function insert_subject($subject){
        global $db;

        $errors = validate_subject($subject);
        if(!empty($errors)){
            return $errors;
        }

        $query = "INSERT INTO subjects ";
        $query .= "(menu_name, position, visible)";
        $query .= "VALUES(";
        $query .= "'" . db_escape($db,$subject['menu_name']) . "',";
        $query .= "'" . db_escape($db,$subject['position']) . "', ";
        $query .= "'" . db_escape($db,$subject['visible']) . "')";

        $result_set = mysqli_query($db,$query);

        if ($result_set) {
            return true;
        }else{
            echo mysql_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_subject($subject){
        global $db;

        $errors = validate_subject($subject);
        if(!empty($errors)){
            return $errors;
        }

        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name='". db_escape($db,$subject['menu_name']) ."',";
        $sql .= "position='". db_escape($db,$subject['position']) ."',";
        $sql .= "visible='". db_escape($db,$subject['visible']) ."' ";
        $sql .= "WHERE id='" . db_escape($db,$subject['id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db,$sql);
        // Para statements de tipo UPDATE obtenemos true/false
        if($result){
            return true;
        }else{
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        } 
    }

    function delete_subject($id){
        global $db;

        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" . db_escape($db,$id) ."' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db, $sql);
        
        if ($result) {
            return true; 
        } else {
            echo mysql_error($db);
            db_disconnect($db);
            exit;
        }    
    }

    
    
?>