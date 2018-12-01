<?php require_once '../../private/initialize.php'?>

<?php 
if (is_post_request())
{
    $gestion_id = $_POST['txt_gestionid'];
}
?>
<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a href="#" onclick="window.location.reload()" data-icon="back" 
            data-iconpos="notext">Refresh</a>
    </div>
    <div data-role="content" class="ui-content">

        <form action="<?php echo url_for('/gestion/save_comentario.php'); ?>" method="post">
            <input type="hidden" name="txt_gestionid" id="txt_gestionid" 
                value="<?php echo $gestion_id;?>">

            <label for="txt_descripcion">Comentario</label>
            <textarea cols="40" rows="8" name="txt_descripcion" 
                id="txt_descripcion" required></textarea>

            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Guardar">
        </form>
    </div>
</div>