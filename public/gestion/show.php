<?php require_once '../../private/initialize.php'?>

<?php 
    $estado_gestion_set = find_all_estado_g();

    $gestiones_set = find_all_gestion();

?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
            <a  href="<?php echo url_for('/index.php');?>" data-rel="back" 
            data-icon="carat-l" data-iconpos="notext">Inicio</a>
    </div>
    <div data-role="content" class="ui-content">

            

            <ul id="list" class="touch" data-role="listview" 
                data-icon="false" data-split-icon="delete">
                <?php while ($gestion = mysqli_fetch_assoc($gestiones_set)) { ?>
                    <li>
                        <a href="<?php echo url_for('/gestion/detail.php?id=' . $gestion['id']);?>">
                            <?php echo "<center><h3>" . $gestion["titulo"] . "</h3>" ?>
                            <?php echo "<h4>Solicitado por: " . $gestion["nombre_usuario"] . "</h4>" ?>
                            <?php echo "<b><h4>" . $gestion["estado_gest"] . "</h4></b></center>" ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

    </div>
</div>