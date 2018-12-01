<?php include_once '../../private/initialize.php'?>
 <?php $page_title = 'Nueva categoria';?>

<?php 

  
    if (is_post_request()) {
        $categoria_nueva = [];
        $categoria_nueva['descripcion'] = $_POST['descripcion'];
        $categoria_nueva['organizacion'] = $_POST['organizacion'];
        $categoria_nueva['estado'] = $_POST['estado'];
    


        $result = insert_categoria($categoria_nueva);

        if ($result === true) {
            $new_id = mysqli_insert_id($db);
            redirect_to(url_for('/categoria/show.php?id='. $new_id));
        } else {
            $errors = $result;
        }

    }

    $option = [];
    $option['activo'] = 'true';
    $organizacion_set = get_all_organization($option);

?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
 <p class="top-space">
        <a class="btn btn-info" href="<?php echo url_for('/admin/pages/index.php');?>">   
            <i class="fas fa-angle-double-left"></i> Regresar a páginas
        </a>
    </p>
        <form action="<?php echo url_for('/categoria/new.php'); ?>" method="post">
            <label for="cbx_categoria" class="select">Organización</label>
            <select name="organizacion" id="cbx_categoria">
            <?php while ($organizacion = mysqli_fetch_assoc($organizacion_set)) {?>
                <option value="<?php echo $organizacion['id']?>">
                    <?php echo $organizacion['nombre']?>
                </option>
            <?php } ?>
            </select>

            <label for="txt_titulo">Nombre</label>
            <input type="text" name="descripcion" id="txt_titulo" required>

             <dl>
                <dt>Estado: &nbsp;&nbsp;  
                    
                    <input type="hidden" name="estado" value="0" />
                    <label>
                    <input type="checkbox" name="estado" value="1" />
                    </label>
                </dt>
      
            </dl>

            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Crear categoría">
        </form>
    </div>
</div>