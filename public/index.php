<?php include_once '../private/initialize.php'; ?>

<?php 
    
if (is_post_request()) {
    $_SESSION['usuario'] = $_POST['txt-nickname'];
    $_SESSION['contrasena'] = $_POST['txt-password'];

}

if ( $_SESSION["usuarioAutenticado"] == null) {
    $credenciales = [];
    $credenciales['usuario'] = $_SESSION['usuario'];
    $credenciales['password'] = $_SESSION['contrasena'];
    $usuarioAutenticado = validate_login($credenciales);

    $_SESSION["usuarioAutenticado"] = $usuarioAutenticado;
} else {
    $usuarioAutenticado = $_SESSION["usuarioAutenticado"];
}
?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <input type="hidden" name="hdd_usuario" id="hdd_usuario" value="<?php echo $usuarioAutenticado['id']; ?>">

    <?php if ($usuarioAutenticado) {?>
        
        <?php include PARTS_PATH . '/menu.php';?>


        <div data-role="content">
            <h1><?php echo $usuarioAutenticado['org_nombre']?></h1>
            <br>
            <h3>Bienvenido <?php echo $usuarioAutenticado['primer_nombre'] . " "
             . $usuarioAutenticado['primer_apellido'];?></h3>
        </div>

    <?php } else { ?>

        <div data-role="content" id="popupDialog" data-overlay-theme="a" 
            data-theme="b" class="ui-content">
            <center>
                <h3>Credenciales inválidas</h3>
                <p>Usuario y contraseña no válidos.</p>
        <a href="login.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" 
            data-rel="back">Aceptar</a>
            </center>
        </div>

    <?php }?>
</div>