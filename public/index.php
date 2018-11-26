<?php include_once '../private/initialize.php'?>


<?php 

    
    if (is_post_request()) {
        $usuario = $_POST['txt-nickname'];
        $contrasena = $_POST['txt-password'];


        if (!$usuario || !$contrasena) {

        } else {
            $credenciales = [];
            $credenciales['usuario'] = $usuario;
            $credenciales['password'] = $contrasena;
            $usuarioAutenticado = validate_login($credenciales);
            
        }
    }

?>

<div data-role="page">
    <div data-role="header" data-theme="a">
        <h1>Control de gestiones</h1>
    </div>

    <?php if ($usuarioAutenticado) {?>
        <?php include PARTS_PATH . '/menu.php';?>
        <div data-role="content">

            

            <h3>Bienvenido <?php echo $usuarioAutenticado['primer_nombre'] . " "
             . $usuarioAutenticado['primer_apellido'];?></h3>
        </div>

    <?php } else { ?>

        <div data-role="content" id="popupDialog" data-overlay-theme="a" 
            data-theme="b" class="ui-content">
            <center>
                <h3>Credenciales inválidas</h3>
                <p>Usuario y contraseña no válidos.</p>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" 
            data-rel="back">Aceptar</a>
            </center>
        </div>

    <?php }?>
</div>