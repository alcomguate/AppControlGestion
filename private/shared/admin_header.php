<?php
    if(!isset($page_title)){$page_title=' Administration';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="<?php echo url_for('/js/jquery.min.js');?>"></script>
    <script src="<?php echo url_for('/js/bootstrap.bundle.min.js');?>"></script>
    <link rel="stylesheet" href="<?php echo url_for('/css/bootstrap.min.css');?>"/>
    <link rel="stylesheet" href="<?php echo url_for('/css/animate.css');?>"/>
    <link rel="stylesheet" href="<?php echo url_for('/css/styles.css'); ?>"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>THE CMS: <?php echo h($page_title); ?></title>
</head>
<body class="container">
    <header class="jumbotron center-text ">
        <h1 class="display-1 bold"><i class="fas fa-newspaper animated flipInY"></i> THE CMS</h1>
        <h3>¡Bienvenido(a) a la zona de adminstración!</h3>
        <p>
            Utilice esta zona para administrar y editar el contenido del CMS (temas y páginas).
            <br>También puede utilizar esta sección para administrar credenciales de usuarios.
        </p>
    </header>

    <nav class="center-text">
        <ul>
            <li><a href="<?php echo url_for('/index.php'); ?>" class="btn btn-info">
            <i class="fas fa-globe-americas"></i> Website</a></li>
            <li><a href="<?php echo url_for('/admin/index.php');?>" class="btn btn-info">
            <i class="far fa-address-card"></i> Menú</a></li>
        </ul>
    </nav>