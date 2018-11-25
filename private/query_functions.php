<?php
    // CRUD Subjects
    function find_all_subjects($options=[]){
        global $db;

        $visible = $options['visible'] ?? false;

        $query = "SELECT * FROM subjects ";

        if($visble) {
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