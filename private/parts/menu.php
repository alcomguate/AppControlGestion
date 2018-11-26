<?php 

    $tipo_usuario = '';
    if ($usuarioAutenticado) {
        $usuario_id = $usuarioAutenticado['id'];
        $tipo_usuario = get_usertype_by_userid($usuario_id);
    }
?>

<div data-role="collapsibleset" data-inset="false">
    <div data-role="collapsible">
        <h3>Menú</h3>
        <ul data-role="listview" data-inset="false">
            <li><a href="<?php echo url_for('/gestion/new.php'); ?>">Crear gestión</a></li>
            <li>Consultar gestión</li>
            <li>Administración</li>
        </ul>
    </div>
</div>