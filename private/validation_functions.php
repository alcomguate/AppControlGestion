<?php
    // is_blank ('texto')
    // validar presencia de datos
    // trim() para que los espacios vacíos no cuenten
    // === para evitar falsos positivos
    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    // has_presence ('texto')
    // validar presencia de datos
    // inverso de is_blank ()
    function has_presence($value) {
        return !is_blank($value);
    }

    // has_lenght_greater_than('texto',5)
    // valida longitud del string
    // espacios cuentan para longitud
    // trim() si espacios no deben contar
    function has_length_greater_than($value, $min) {
        $length = strlen($value);
        return $length > $min;
    }

    // has_lenght_less_than('texto',5)
    // valida longitud del string
    // espacios cuentan para longitud
    // trim() si espacios no deben contar
    function has_length_less_than($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }


    // has_length_exactly('texto', 4)
    // valida string length
    // espacios cuentan para longitud
    // trim() si espacios no deben contar
    function has_length_exactly($value, $exact) {
        $length = strlen($value);
        return $length == $exact;
    }

    // has_length('texto', ['min' => 3, 'max' => 5])
    // valida string length
    // combinación de funciones _greater_than, _less_than, _exactly
    // espacios cuentan para longitud
    // trim() si espacios no deben contar
    function has_length($value, $options) {
        if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
        } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
        } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
        } else {
        return true;
        }
    }

    // has_inclusion_of( 5, [1,3,5,7,9] )
    // valida la inclusion en un set
    function has_inclusion_of($value, $set) {
        return in_array($value, $set);
    }

    // has_exclusion_of( 5, [1,3,5,7,9] )
    // valida la exclusion en un set
    function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
    }

    // has_string('aruiz@udeo.com', '.com')
    // valida inclusion de caracter(es)
    // strpos retorna la posición inicial del string o false
    // !== para prevenir que la posision 0 desde el inicio sea considerada false
    // strpos se más veloz que preg_match()
    function has_string($value, $required_string) {
        return strpos($value, $required_string) !== false;
    }

    // has_valid_email_format('aruiz@udeo.com')
    // valida que la dirección de correo electrónico sea correcta
    //  * formato: [chars]@[chars].[2+ letras]
    //  * preg_match utiliza expresiones regulares
    //    retorna 1 si hay match, 0 si no hay match
    //    http://php.net/manual/es/function.preg-match.php
    function has_valid_email_format($value) {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex, $value) === 1;
    }

    // has_unique_page_menu_name('The CMS')
    // Valida que pages.menu_name sea único
    // Para nuevos registros, proveer únicamente el menu_name.
    // Para registros existentes, proveer el ID actual como segundo argumento
    // has_unique_page_menu_name('The CMS', 1)
    function has_unique_page_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name='" . db_escape($db, $menu_name) . "' AND ";
    $sql .= "id!= '" . db_escape($db, $menu_name) . "' ";

    $page_set = mysqli_query($db, $sql);
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);

    return $page_count === 0;
  }
?>

