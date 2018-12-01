<?php require_once('../../private/initialize.php');?>

<?php 
$id = $_GET['id'] ?? '1';
$categoria = find_categoria_by_id($id);

?>

<?php $page_title = 'Mostrando Categoría'; ?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
<section>
    <p class="top-space">
        <a class="btn btn-success" href="<?php echo url_for('/categoria/index.php');?>">
            <i class="fas fa-angle-double-left"></i> Regresar a categoría
        </a>
    </p>

    <section class="info">
        <?php $subject = find_categoria_by_id($categoria['id']); ?>    
         <?php $organizacion = find_organizacion_by_id($categoria['organizacion']); ?>
        <h2 class="bold top-space bottom-space"><?php echo strtoupper(h($categoria['descripcion']));?></h2>
        <table class="table center-text">

<table data-role="table" id="table-column-toggle"  class="ui-responsive table-stroke">
     <thead>
       <tr>
         <th data-priority="2">Nombre</th>
         <th>Organización</th>
         <th data-priority="3">Activo</th>
       </tr>
     </thead>
     <tbody>
       <tr>
         <td><?php echo h($categoria['descripcion']);?></td>
         <td><?php echo h($organizacion['nombre']);?></td>
         <td><?php echo $categoria['activo'] == 1 ? 'Sí':'No'; ?></td>
       </tr>
     
     </tbody>
  
    </section>
</section>
