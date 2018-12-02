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
    cerrar_gestion($gestion_id);
    
}
?>
<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a  href="<?php echo url_for('/index.php');?>" data-rel="back" 
            data-icon="carat-l" data-iconpos="notext">Inicio</a>
    </div>
    <div data-role="content" class="ui-content">
    <form action="<?php echo url_for('/gestion/detail.php'); ?>" method="post">
        
        <h1>Gestion finalizada</h1>
        <input type="hidden" name="txt_gestionid" id="txt_gestionid" 
                value="<?php echo $gestion_id;?>">
            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Aceptar">
        
    </form>
    </div>
</div>