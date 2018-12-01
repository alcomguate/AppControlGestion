<?php
require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/categoria/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    $categoria = [];
    $categoria['id'] = $id;
    $categoria['descripcion'] = $_POST['descripcion'] ?? '';
    $categoria['activo'] = $_POST['activo'] ?? '';
    $categoria['organizacion'] = $_POST['organizacion'] ?? '';
    var_dump($categoria);
   
  
    $result = update_categoria($categoria);
    if($result === true){
        redirect_to(url_for('/categoria/show.php?id=' . $id));
    }else{
        $errors = $result;
    }
}else{
    $categoria = find_categoria_by_id($id);
   
}
$categorias_set = get_all_category();
$categoria_count = mysqli_num_rows($categorias_set);    
mysqli_free_result($categorias_set);
?>

<?php $categoria_title = 'Editar Página';?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
<section>
    <p class="top-space">
        <a class="btn btn-info" href="<?php echo url_for('/categoria/index.php');?>">   
            <i class="fas fa-angle-double-left"></i> Regresar a páginas
        </a>
    </p>
    <section class="forms">
        <h3 class="bold top-space">¿Editar <?php echo strtoupper(h($categoria['descripcion']));?>?</h3>
        <?php echo display_errors($errors);?>
        <form action="<?php echo url_for('/categoria/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Organización
                    <select name="organizacion">
                    <?php
                        $organizacion_set = get_all_organization();
                        while($organizacion= mysqli_fetch_assoc($organizacion_set)) {
                        echo "<option value=\"" . h($organizacion['id']) . "\"";
                        if($organizacion["id"] == $organizacion['id']) {
                            echo " selected";
                        }
                        echo ">" . h($organizacion['nombre']) . "</option>";
                        }
                        mysqli_free_result($organizacion_set);
                    ?>
                    </select>
                </dt>
            </dl>
            <dl>
                <dt>Nombre de la Categoría: </dt>
                <dd><input type="text" name="descripcion" value="<?php echo h($categoria['descripcion'])?>"/></dd>
            </dl>

            <dl>
               
                <dt>Activo: &nbsp;&nbsp;  
                     <label>
                    <input type="hidden" name="activo" value="0" />
                    <input type="checkbox" name="activo" value="1"<?php if($categoria['activo'] == "1") { echo " checked"; } ?> />
                    </label>
                </dt>
                
            </dl>
           
            <div id="operations">
                <button type="submit" class="btn btn-success">
                    <i class="far fa-pencil-alt"></i> Guardar categoria
                </button>
            </div>
        </form>
    </section>
    <p class="white-space"></p>
</section>

