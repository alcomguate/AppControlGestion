<?php require_once '../../private/initialize.php'?>

<?php 

    $usuario = '';
    if (is_post_request()) {
        $gestion_nueva = [];
        $gestion_nueva['titulo'] = $_POST['txt_titulo'];
        $gestion_nueva['descripcion'] = $_POST['txt_descripcion'];
        $gestion_nueva['usuario_solicita'] = $_POST['hd_usuario'];
        $gestion_nueva['categoria'] = $_POST['cbx_categoria'];

        $result = insert_gestion($gestion_nueva);
        if ($result === true) {
            $new_id = mysqli_insert_id($db);
            redirect_to(url_for('/gestion/show.php?id=' . $new_id));
        } else {
            $errors = $result;
        }

    }
    else {
        $usuario = $_GET['user'];
    }

    $option = [];
    $option['activo'] = 'true';
    $categoria_set = get_all_category($option);

?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a  href="<?php echo url_for('/index.php');?>" data-rel="back" 
            data-icon="carat-l" data-iconpos="notext">Inicio</a>
    </div>
    <div data-role="content">

        <form action="<?php echo url_for('/gestion/new.php'); ?>" method="post">
            <label for="cbx_categoria" class="select">Categoría</label>
            <select name="cbx_categoria" id="cbx_categoria">
            <?php while ($categoria = mysqli_fetch_assoc($categoria_set)) {?>
                <option value="<?php echo $categoria['id']?>">
                    <?php echo $categoria['descripcion']?>
                </option>
            <?php } ?>
            </select>

            <label for="txt_titulo">Título</label>
            <input type="text" name="txt_titulo" id="txt_titulo" maxlength="100" required>

            <label for="txt_descripcion">Descripción</label>
            <textarea cols="40" rows="8" name="txt_descripcion" 
                id="txt_descripcion" maxlength="1000" required></textarea>

            <label for="fecha_actual">Fecha de solicitud</label>
            <input type="text" name="fecha_actual" id="fecha_actual" 
                value="<?php echo display_currentdate();?>" readonly>

            <input type="hidden" name="hd_usuario" id="hd_usuario" 
                value="<?php echo $usuario;?>">

            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Crear solicitud">
        </form>
    </div>
</div>