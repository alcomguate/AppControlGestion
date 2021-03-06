<?php require_once '../../private/initialize.php'?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a  href="<?php echo url_for('/index.php');?>" data-rel="back" 
            data-icon="carat-l" data-iconpos="notext">Inicio</a>
    </div>
    <div data-role="content" class="ui-content">

        <ul id="list" class="touch" data-role="listview" 
            data-icon="false" data-split-icon="plus">
            <li>
                <a href="<?php echo url_for('/usuario/new.php');?>">
                    <h1>Crear usuario</h1>
                </a>
            </li>
            <li>
                <a href="<?php echo url_for('/usuario/index.php');?>">
                    <h1>Consultar usuarios</h1>
                </a>
            </li>
            <li>
                <a href="<?php echo url_for('/categoria/new.php');?>">
                    <h1>Crear categoría</h1>
                </a>
            </li>
            <li>
                <a href="<?php echo url_for('/categoria/index.php');?>">
                    <h1>Consultar categorías</h1>
                </a>
            </li>
        </ul>
    </div>
</div>