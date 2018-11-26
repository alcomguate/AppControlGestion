<?php include_once '../private/initialize.php'?>

<?php 

    $option = [];
    $option['activo'] = 'true';
    $organizacion_set = get_all_organization($option);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Control de gestiones - Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" 
        href="<?php echo url_for('/css/jquery.mobile-1.3.0.min.css'); ?>">
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

            <label for="cbx_organization" class="select">Organización</label>
            <select name="cbx_organization" id="cbx_organization">
            <?php while ($organizacion = mysqli_fetch_assoc($organizacion_set)) {?>
                <option value="<?php echo $organizacion['id']?>">
                    <?php echo $organizacion['nombre']?>
                </option>
            <?php } ?>
            </select>
            <label for="txt-nickname">Usuario</label>
            <input type="text" name="txt-nickname" id="txt-nickname" value="pgomez">
            
            <label for="txt-password">Contraseña</label>
            <input type="password" name="txt-password" id="txt-password" value="123456">
            
            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                value="Iniciar sesión">

            

        </form>
        </div><!-- /content -->
    </div><!-- /page -->
</body>
</html>