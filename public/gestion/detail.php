<?php require_once '../../private/initialize.php'?>

<?php 
    $idgestion = $_GET['id'];
    $gestion = find_gestion_by_id($idgestion);
?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
                <a href="#" onclick="window.location.reload()" data-icon="back" 
            data-iconpos="notext">Refresh</a>
    </div>
    <div data-role="content">

        <form action="<?php echo url_for('/gestion/comentario.php'); ?>" method="post">

        <input type="hidden" name="txt_gestionid" id="txt_gestionid" value="<?php echo $gestion['id'];?>">
        <label for="txt_titulo">Título</label>
        <input type="text" id="txt_titulo" name="txt_titulo" readonly
            value="<?php echo $gestion['titulo']; ?>">

        <label for="txt_descripcion">Descripción</label>
        <input type="text" id="txt_descripcion" name="txt_descripcion" readonly
            value="<?php echo $gestion['descripcion']; ?>">

        <label for="txt_fechaemision">Fecha de emisión</label>
        <input type="text" id="txt_fechaemision" name="txt_fechaemision" readonly
            value="<?php echo $gestion['fecha_emision']; ?>">

        <label for="txt_categoria">Categoría</label>
        <input type="text" id="txt_categoria" name="txt_categoria" readonly
            value="<?php echo $gestion['cat_descripcion']; ?>">

        <label for="txt_estado">Estado</label>
        <input type="text" id="txt_estado" name="txt_estado" readonly
            value="<?php echo $gestion['estado_descripcion']; ?>">

        <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-plus" 
                    value="Ver comentarios">
        
        <a href="" 
            class="ui-btn ui-corner-all ui-shadow ui-btn-icon-left ui-icon-plus">Finalizar gestion</a>
        </form>
    </div>
</div>