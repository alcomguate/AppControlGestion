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
function find_all_gestion() 
{
    global $db;

    $query = "SELECT G.*, U.nombre_usuario, EG.descripcion 'estado_gest' FROM Gestion G ";
    $query .= "INNER JOIN Usuario U ON U.id = G.usuario_solicita ";
    $query .= "INNER JOIN Estado_gestion EG ON EG.id = G.estado ";
    
    var_dump($query);
    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;
}

function find_gestion_by_id($id) 
{
    global $db;

    $query = "SELECT G.*, U.nombre_usuario 'nombre_usr_solicita', ";
    $query .= "U2.nombre_usuario 'nombre_usr_seguimiento', CA.descripcion 'cat_descripcion', ";
    $query .= "EG.descripcion 'estado_descripcion' ";
    $query .= "FROM Gestion G INNER JOIN Usuario U ON U.id = G.usuario_solicita ";
    $query .= "LEFT JOIN Usuario U2 ON U2.id = G.usuario_seguimiento ";
    $query .= "INNER JOIN Categoria CA ON CA.id = G.categoria ";
    $query .= "INNER JOIN Estado_gestion EG ON EG.id = G.estado ";
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

function update_usuario($usuario)
{
    global $db;

    /*
    $errors = validate_categoria($categoria);
    if(!empty($errors)){
        return $errors;
    }*/

    $sql = "UPDATE Usuario SET ";
    $sql .= "nombre_usuario='". db_escape($db,$usuario['nombre_usuario']) ."',";
    $sql .= "primer_nombre='". db_escape($db,$usuario['primer_nombre']) ."',";
    $sql .= "segundo_nombre='". db_escape($db,$usuario['segundo_nombre']) ."',";
    $sql .= "primer_apellido='". db_escape($db,$usuario['primer_apellido']) ."',";
    $sql .= "segundo_apellido='". db_escape($db,$usuario['segundo_apellido']) ."',";
    $sql .= "genero='". db_escape($db,$usuario['genero']) ."',";
    $sql .= "fecha_nacimiento='". db_escape($db,$usuario['fecha_nacimiento']) ."',";
    $sql .= "correo_electronico='". db_escape($db,$usuario['correo_electronico']) ."',";
    $sql .= "contrasena='". db_escape($db,$usuario['contrasena']) ."',";
    $sql .= "tipo_usuario='". db_escape($db,$usuario['tipo_usuario']) ."',";
    $sql .= "activo=". db_escape($db,$usuario['activo']) .",";
    $sql .= "organizacion='". db_escape($db,$usuario['organizacion']) . "'";
    $sql .= "WHERE id='" . db_escape($db,$usuario['id']) . "' ";
    $sql .= "LIMIT 1";

    var_dump($sql);

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

function delete_usuario($id){
    global $db;

    $sql = "DELETE FROM Usuario ";
    $sql .= "WHERE id='" . db_escape($db,$id) ."' ";
    $sql .= "LIMIT 1";
//var_dump($sql);
    $result = mysqli_query($db, $sql);
    
    if ($result) {
        return true; 
    } else {
        echo mysql_error($db);
        db_disconnect($db);
        exit;
    }    
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

// CRUD categorias
function find_all_categoria($options=[]) 
{
    global $db;

    $visible = $options['activo'] ?? false;

    $query = "SELECT * FROM Categoria ";

    if ($visible) {
        $query .= " WHERE activo = true ";
    }
   
    $result_set = mysqli_query($db,$query);
    confirm_result_set($result_set);
    return $result_set;
}

function find_categoria_by_id($id)
{
    global $db;
    $query = "SELECT * FROM Categoria ";
    $query .= "WHERE id='" . db_escape($db,$id) . "'";
    $result_set = mysqli_query($db,$query);
    confirm_result_set($result_set);
    $subject = mysqli_fetch_assoc($result_set);
    mysqli_free_result($result_set);
    return $subject; // return como un arreglo asociativo
}

function update_categoria($categoria)
{
    global $db;

    $errors = validate_categoria($categoria);
    if(!empty($errors)){
        return $errors;
    }

    $sql = "UPDATE Categoria SET ";
    $sql .= "descripcion='". db_escape($db,$categoria['descripcion']) ."',";
    $sql .= "organizacion='". db_escape($db,$categoria['organizacion']) ."',";
    $sql .= "activo='". db_escape($db,$categoria['activo']) ."' ";
    $sql .= "WHERE id='" . db_escape($db,$categoria['id']) . "' ";
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

function delete_categoria($id)
{
    global $db;

    $sql = "DELETE FROM Categoria ";
    $sql .= "WHERE id='" . db_escape($db, $id) ."' ";
    $sql .= "LIMIT 1";
var_dump($sql);
    $result = mysqli_query($db, $sql);
    
    if ($result) {
        return true; 
    } else {
        echo mysql_error($db);
        db_disconnect($db);
        exit;
    }    
}

function insert_categoria($categoria)
{
         
        
    global $db;

    $errors = validate_categoria($categoria);
    if(!empty($errors)){
        return $errors;
     
    }

    $query = "INSERT INTO Categoria ";
    $query .= "(organizacion, descripcion, activo)";
    $query .= "VALUES(";
    $query .= "'" . db_escape($db,$categoria['organizacion']) . "',";
    $query .= "'" . db_escape($db,$categoria['descripcion']) . "', ";
    $query .= "'" . db_escape($db,$categoria['estado']) . "')";

    $result_set = mysqli_query($db,$query);
  
  
    if ($result_set) {
        return true;
  
       
    }else{
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

// Querys de comentarios
function find_all_comentario_gestio($gestion_id) 
{
    global $db;

    $query = "SELECT CG.*, U.nombre_usuario FROM Comentario_gestion CG ";
    $query .= "INNER JOIN Usuario U ON U.id = CG.usuario ";
    $query .= "WHERE gestion = " . db_escape($db, $gestion_id);

    $result_set = mysqli_query($db, $query);
    confirm_result_set($result_set);
    return $result_set;
}

function insert_comentario($comentario)
{
    global $db;

    $query = "INSERT INTO Comentario_gestion ";
    $query .= "(gestion, comentario, fecha_creacion, usuario)";
    $query .= "VALUES(";
    $query .= "'" . db_escape($db, $comentario['gestion']) . "',";
    $query .= "'" . db_escape($db, $comentario['comentario']) . "', ";
    $query .= "SYSDATE(), ";
    $query .= "'" . db_escape($db, $comentario['usuario']) . "')";

    error_log($query);
    $result_set = mysqli_query($db, $query);
  
    if ($result_set) {
        return true;
    }
}

function cerrar_gestion($gestion) 
{
    global $db;


    $sql = "UPDATE Gestion SET ";
    $sql .= "estado='2'";
    $sql .= "WHERE id='" . db_escape($db, $gestion) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db,$sql);
    if ($result) {
        return true;
    }
}

?>