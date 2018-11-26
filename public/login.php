<?php include_once '../private/initialize.php'?>

<!DOCTYPE html>
<html>
<head>
    <title>Control de gestiones - Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="<?php echo url_for('/css/jquery.mobile-1.3.0.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('/css/style.css'); ?>">
    <script src="<?php echo url_for('/js/jquery.js'); ?>"></script>
    <script src="<?php echo url_for('/js/jquery.mobile-1.3.0.js'); ?>"></script>

</head>
<body>
<div data-role="page">
        <div data-role="header" data-theme="a">
            <h1>Control de gestiones</h1>
        </div>

        <div role="main" class="ui-content">
        <form action="index.php" method="post">
            <h3>Iniciar sesión</h3>
            <label for="txt-nickname">Usuario</label>
            <input type="text" name="txt-nickname" id="txt-nickname" value="">
            <label for="txt-password">Contraseña</label>
            <input type="password" name="txt-password" id="txt-password" value="">
            
            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" value="Aceptar">

            

        </form>
        </div><!-- /content -->
    </div><!-- /page -->
</body>
</html>