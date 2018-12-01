<?php require_once '../../private/initialize.php'?>

<?php 
    $estado_gestion_set = find_all_estado_g();

    $gestiones_set = find_all_gestion($options = []);

?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
        <a href="#" onclick="window.location.reload()" data-icon="back" 
            data-iconpos="notext">Refresh</a>
    </div>
    <div data-role="content" class="ui-content">

            <label for="cbx_estado" class="select">Estado</label>
            <select name="cbx_estado" id="cbx_estado">
            <?php while ($estado = mysqli_fetch_assoc($estado_gestion_set)) {?>
                <option value="<?php echo $estado['id']?>">
                    <?php echo $estado['descripcion']?>
                </option>
            <?php } ?>
            </select>
            <br>

            <ul id="list" class="touch" data-role="listview" 
                data-icon="false" data-split-icon="delete">
                <?php while ($gestion = mysqli_fetch_assoc($gestiones_set)) { ?>
                    <li>
                        <a href="<?php echo url_for('/gestion/detail.php?id=' . $gestion['id']);?>">
                            <?php echo "<center><h3>" . $gestion["titulo"] . "</h3>" ?>
                            <?php echo "<h4>Solicitado por: " . $gestion["nombre_usuario"] . "</h4></center>" ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

    </div>
</div>