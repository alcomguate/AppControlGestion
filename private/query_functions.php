<?php

// Obteniendo todas las organizaciones
function get_all_organization($options=[]) 
{
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
function get_all_category($options=[]) 
{
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
function validate_login($credenciales=[]) 
{
    global $db;

    $nombre_usuario = $credenciales['usuario'];
    $contrasena = $credenciales['password'];

    $query = "SELECT U.*, O.nombre 'org_nombre' FROM Usuario U INNER JOIN Organizacion O ";
    $query .= " ON O.id = U.organizacion ";
    $query .= "WHERE nombre_usuario = '" . db_escape($db, $nombre_usuario);
    $query .= "' AND contrasena = '" . db_escape($db, $contrasena) . "' LIMIT 1";

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    $resultado = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return $resultado;
}

// obtener permisos del usuario
function get_usertype_by_userid($user_id) 
{
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

// Estado de gestion
function find_all_estado_g() 
{
    global $db;

    $query = "SELECT * FROM Estado_gestion";

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;
}

// CRUD Gestion
function find_all_gestion($options = []) 
{
    global $db;

    $estado = $options['estado'];
    
    $query = "SELECT G.*, U.nombre_usuario FROM Gestion G INNER JOIN Usuario U ON U.id = G.usuario_solicita ";

    if ($estado) {
        $query .= "WHERE estado = " . $estado;
    }

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;
}

function find_gestion_by_id($id) 
{
    global $db;

    $query = "SELECT G.*, U.nombre_usuario 'nombre_usr_solicita', ";
    $query .= "U2.nombre_usuario 'nombre_usr_seguimiento', CA.descripcion 'cat_descripcion' ";
    $query .= "FROM Gestion G INNER JOIN Usuario U ON U.id = G.usuario_solicita ";
    $query .= "LEFT JOIN Usuario U2 ON U2.id = G.usuario_seguimiento ";
    $query .= "INNER JOIN Categoria CA ON CA.id = G.categoria ";
    $query .= "WHERE G.id='" . db_escape($db, $id) . "' LIMIT 1";
    var_dump($query);
    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    $subject = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return $subject;
}

function insert_gestion($gestion) 
{
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

    $result_set = mysqli_query($db, $query);

    if ($result_set) {
        return true;
    } else {
        // echo mysql_error($db);
        db_disconnect($db);
        exit;
    }
}

function validate_gestion($gestion) 
{
    $errors = [];
    
    if (is_blank($gestion['titulo'])) {
        $errors[] = "Título no puede estar en blanco.";
    } elseif (!has_length($gestion['titulo'], ['min' => 2, 'max' => 100])) {
        $errors[] = "Título debe contener entre 2 y 100 caracteres.";
    }
    
    if (is_blank($gestion['descripcion'])) {
        $errors[] = "Descripción no puede estar en blanco.";
    } elseif (!has_length($gestion['descripcion'], ['min' => 2, 'max' => 1000])) {
        $errors[] = "Descripción debe contener entre 2 y 1000 caracteres.";
    }

    return $errors;
}

//CRUD USUARIO
function insert_usuario($usuario)
{
    global $db;

    /*
    $errors = validate_usuario($usuario);
    if(!empty($errors)){
        return $errors;
    }*/

    $query = "INSERT INTO Usuario ";
    $query .= "(nombre_usuario, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, correo_electronico, contrasena, tipo_usuario, activo, organizacion)";
    $query .= "VALUES(";
    $query .= "'" . db_escape($db,$usuario['nombre_usuario']) . "',";
    $query .= "'" . db_escape($db,$usuario['primer_nombre']) . "',";
    $query .= "'" . db_escape($db,$usuario['segundo_nombre']) . "',";
    $query .= "'" . db_escape($db,$usuario['primer_apellido']) . "',";
    $query .= "'" . db_escape($db,$usuario['segundo_apellido']) . "',";
    $query .= "'" . db_escape($db,$usuario['genero']) . "',";
    $query .= "'" . db_escape($db,$usuario['fecha_nacimiento']) . "',";
    $query .= "'" . db_escape($db,$usuario['correo_electronico']) . "',";
    $query .= "'" . db_escape($db,$usuario['contrasena']) . "',";
    $query .= "'" . db_escape($db,$usuario['tipo_usuario']) . "',";
    $query .= "" . db_escape($db,$usuario['activo']) . ",";
    $query .= "'" . db_escape($db,$usuario['organizacion']) . "')";


    var_dump($query);

    $result_set = mysqli_query($db,$query);
  
  
    if ($result_set) {
        return true;
  
       
    }else{
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function get_all_usuario($options=[]) 
{
    global $db;

    $activo = $options['activo'];
    
    $query = "SELECT * FROM Usuario ";

    if ($activo) {
        $query .= "WHERE activo = true";
    }

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;
}

function find_all_usuario($options=[]) 
{
    global $db;

    $visible = $options['activo'] ?? false;

    $query = "SELECT * FROM Usuario ";

    if ($visible) {
        $query .= " WHERE activo = true ";
    }

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;

}

function find_organizacion_by_id($id)
{
    global $db;
    $query = "SELECT * FROM Organizacion ";
    $query .= "WHERE id='" . db_escape($db,$id) . "'";
    $result_set = mysqli_query($db,$query);
    confirm_result_set($result_set);
    $subject = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return $subject; // return como un arreglo asociativo
}

function find_usuario_by_id($id)
{
    global $db;
    $query = "SELECT * FROM Usuario ";
    $query .= "WHERE id='" . db_escape($db,$id) . "'";
    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    $subject = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return $subject; // return como un arreglo asociativo
}

function find_tipo_usuario_by_id($id)
{
    global $db;
    $query = "SELECT * FROM Tipo_usuario ";
    $query .= "WHERE id='" . db_escape($db,$id) . "'";
    $result_set = mysqli_query($db,$query);
    confirm_result_set($result_set);
    $subject = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return $subject; // return como un arreglo asociativo
}

function get_all_tipo_usuario($options=[]) 
{
    global $db;

    $activo = $options['activo'];
    
    $query = "SELECT * FROM Tipo_usuario ";

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;
}

?>