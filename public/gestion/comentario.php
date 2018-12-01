<?php require_once '../../private/initialize.php'?>

<?php 
if (is_post_request()) {
    $gestion_id = $_POST['txt_gestionid'];
    $comentarios_set = find_all_comentario_gestio($gestion_id);
}

?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a href="#" onclick="window.location.reload()" data-icon="back" 
            data-iconpos="notext">Refresh</a>
    </div>
    <div data-role="content" class="ui-content">

        <form action="<?php echo url_for('/gestion/new_comentario.php'); ?>" method="post">

            <input type="hidden" name="txt_gestionid" id="txt_gestionid" 
            value="<?php echo $gestion_id;?>">

            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Agregar comentario">

            <ul id="list" class="touch" data-role="listview" 
                data-icon="false" data-split-icon="delete">
                <?php while ($comentario = mysqli_fetch_assoc($comentarios_set)) { ?>
                    <li>
                        <h1><?php echo $comentario['no_comentario']?></h1><br>
                        <p><?php echo $comentario['comentario']?><p>
                    </li>
                <?php } ?>
            </ul>
        </form>
    </div>
</div>