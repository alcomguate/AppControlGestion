<?php require_once('../../private/initialize.php');?>

<?php $categorias_set = find_all_categoria();?>

<?php $page_title='Páginas Categorías';?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
<section>
    <h3 class="top-space">Administración de Categorías</h3>

    <section class="top-space">
        <a class="btn btn-success" href="<?php echo url_for('/categoria/new.php'); ?>">
            <i class="far fa-file"></i> Crear nueva categoría
        </a>
        <p class="top-space"></p>
    </section>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th class="center-text">Nombre</th>
                <th class="center-text">Organización</th>
                <th class="center-text">Activo</th>
         
                <th>Nombre</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php while ($categoria = mysqli_fetch_assoc($categorias_set)) {?>
                <?php $organizacion = find_organizacion_by_id($categoria['organizacion']); ?>
                <tr>
                    <td class="center-text"><?php echo h($categoria['id']);?></td>
                    <td class="center-text"><?php echo h($organizacion['nombre']);?></td>
                    <td class="center-text"><?php echo h($categoria['descripcion']);?></td>
                    <td class="center-text"><?php echo $categoria['activo'] == 1 ? 'Sí':'No';?></td>
            
                    <td><a href="<?php echo url_for('/categoria/show.php?id=' . h(u($categoria['id'])));?>">Ver</a></td>
                    <td><a href="<?php echo url_for('/categoria/edit.php?id=' . h(u($categoria['id'])));?>">Editar</a></td>
                    <td><a href="<?php echo url_for('/categoria/delete.php?id=' . h(u($categoria['id']))); ?>">Eliminar</a></td>
                </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($categorias_set);?>
    </div>
   
</section>
