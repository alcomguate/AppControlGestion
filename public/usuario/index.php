<?php require_once('../../private/initialize.php');?>

<?php $usuarios_set = find_all_usuario();?>

<?php $page_title='Páginas Usuarios';?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
<section>
    <h3 class="top-space">Administración de Usuarios</h3>

    <section class="top-space">
        <a class="btn btn-success" href="<?php echo url_for('/usuario/new.php'); ?>">
            <i class="far fa-file"></i> Crear nuevo usuario
        </a>
        <p class="top-space"></p>
    </section>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th class="center-text">Id</th>
                <th class="center-text">Usuario</th>
                <th class="center-text">Nombre</th>
                <!--<th class="center-text">Organización</th>-->
                <th class="center-text">Ver</th>
                <th class="center-text">Editar</th>
                <th class="center-text">Eliminar</th>
            </tr>
            <?php while ($usuario = mysqli_fetch_assoc($usuarios_set)) {?>
                <?php $organizacion = find_organizacion_by_id($usuario['organizacion']); ?>
                <tr>
                    <td class="center-text"><?php echo h($usuario['id']);?></td>
                    <td class="center-text"><?php echo h($usuario['nombre_usuario']);?></td>
                    <td class="center-text"><?php echo h($usuario['primer_nombre']); echo " " ;echo h($usuario['primer_apellido']);?></td>

                    <!--<td class="center-text"><?php //echo h($organizacion['nombre']);?></td>-->
                    <td><!--<a href="<?php //echo url_for('/categoria/show.php?id=' . h(u($categoria['id'])));?>">Ver</a>-->
            <a href="<?php echo url_for('/usuario/show.php?id=' . h(u($usuario['id'])));?>" class="ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext">Ver</a>

                    </td>
                    <td><!--<a href="<?php //echo url_for('/categoria/edit.php?id=' . h(u($categoria['id'])));?>">Editar</a>-->
                        
<a href="<?php echo url_for('/usuario/edit.php?id=' . h(u($usuario['id'])));?>" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext">Editar</a>

                    </td>
                    <td><!--<a href="<?php //echo url_for('/categoria/delete.php?id=' . h(u($categoria['id']))); ?>">Eliminar</a>-->
                        
                        <a href="<?php echo url_for('/usuario/delete.php?id=' . h(u($usuario['id']))); ?>" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($usuarios_set);?>
    </div>


   
</section>



