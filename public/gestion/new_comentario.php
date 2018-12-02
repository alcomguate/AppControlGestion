<?php require_once '../../private/initialize.php'?>

<?php 
$fin_gestion = null;
if (is_post_request())
{
    $gestion_id = $_POST['txt_gestionid'];
} else {
    $fin_gestion = $_GET['fin'];
    $gestion_id = $_GET['gestion'];
}
?>
<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a  href="<?php echo url_for('/index.php');?>" data-rel="back" 
            data-icon="carat-l" data-iconpos="notext">Inicio</a>
    </div>
    <div data-role="content" class="ui-content">

        <form action="<?php if ($fin_gestion) {echo url_for('/gestion/fin_gestion.php');} else { echo url_for('/gestion/save_comentario.php'); } ?>" method="post">
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