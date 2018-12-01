<?php include_once '../private/initialize.php'; ?>


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

    <link rel="stylesheet" href="<?php echo url_for('/css/jquery.mobile-1.4.5.min.css'); ?>">    
    <link rel="stylesheet" href="<?php echo url_for('/css/style.css'); ?>">
    <link rel="stylesheet" 
        href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    
    <script src="<?php echo url_for('/js/jquery.js'); ?>"></script>
    <script src="<?php echo url_for('/js/jquery.mobile-1.4.5.min.js'); ?>"></script>

</head>

<body>
    <div data-role="page">
        <div data-role="header" data-theme="b">
            <h1>Control de gestiones</h1>
        </div>

        <div role="main" class="ui-content">
        <form action="index.php" method="post" class="ui-content">
            <h3>Iniciar sesión</h3>

            <label for="txt-nickname">Usuario</label>
            <input type="text" name="txt-nickname" id="txt-nickname" value="pgomez">
            
            <label for="txt-password">Contraseña</label>
            <input type="password" name="txt-password" id="txt-password" 
                value="123456">
            
            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b"
                value="Iniciar sesión">

        </form>
        </div>
    </div>
</body>
</html>