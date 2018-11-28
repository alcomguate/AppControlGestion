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
            <?php if ($tipo_usuario['crea_gestion']) {?>
            <li>
                <a href="<?php echo url_for('/gestion/new.php?user=' . $usuario_id); ?>">
                    Crear gestión
                </a>
            </li>
            <?php } ?>
            <?php if ($tipo_usuario['sigue_gestion']) {?>
            <li>
                <a href="<?php echo url_for('/gestion/new.php'); ?>">
                    Consultar gestión
                </a>
            </li>
            <?php } ?>
            <?php if ($tipo_usuario['es_administrador']) {?>
            <li>
                <a href="<?php echo url_for('/gestion/new.php'); ?>">
                    Administración
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>