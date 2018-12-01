<?php require_once '../../private/initialize.php'?>

<?php 
if (is_post_request())
{
    $gestion_id = $_POST['txt_gestionid'];
    $comentario = $_POST['txt_descripcion'];
    $data = [];
    $data['gestion'] = $gestion_id;
    $data['comentario'] = $comentario;
    $data['usuario'] = '1';
    insert_comentario($data);
    
}
?>
<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a href="#" onclick="window.location.reload()" data-icon="back" 
            data-iconpos="notext">Refresh</a>
    </div>
    <div data-role="content" class="ui-content">
    <form action="<?php echo url_for('/gestion/detail.php'); ?>" method="post">
        
        <h1>Comentario guardado en el sistema</h1>
        <input type="hidden" name="txt_gestionid" id="txt_gestionid" 
                value="<?php echo $gestion_id;?>">
            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Aceptar">
        
    </form>
    </div>
</div>