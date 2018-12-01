<?php
require_once('../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/usuario/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_usuario($id);
  redirect_to(url_for('/usuario/index.php'));

} else {
  $usuario = find_usuario_by_id($id);
}

?>

<?php $page_title = 'Eliminar usuario'; ?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
<section>
    <p class="top-space">
        <a class="btn btn-info" href="<?php echo url_for('/usuario/index.php');?>">   
            <i class="fas fa-angle-double-left"></i> Regresar a usuarios
        </a>
    </p>

    <section class="forms">
        <h3 class="bold top-space">¿Eliminar <?php echo strtoupper(h($usuario['nombre_usuario']));?>?</h3>
        <p>
            ¿Esta seguro que desea eliminar este usuario?<br/>
            <i class="fas fa-exclamation-triangle"></i> <mark>&nbsp;Se eliminará definitivamente de la base de datos&nbsp;</mark>
        </p> 
        <form action="<?php echo url_for('/usuario/delete.php?id=' . h(u($id))); ?>" method="post">
            <div id="operations">
                <button type="submit" name="commit" class="btn btn-danger">
                    <i class="far fa-trash-alt"></i> &nbsp;Eliminar usuario
                </button>
            </div>
        </form>
    </section>
    <p class="white-space"></p>
</section>

