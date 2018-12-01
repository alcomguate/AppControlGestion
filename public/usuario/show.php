<?php require_once('../../private/initialize.php');?>

<?php 
$id = $_GET['id'] ?? '1';
$usuario = find_usuario_by_id($id);

?>

<?php $page_title = 'Mostrando Usuario'; ?>

<div data-role="page">
    <div data-role="header" data-theme="a">
        <h1>Usuario</h1>
    </div>
    <div data-role="content">
<section>
    <p class="top-space">
        <a class="btn btn-success" href="<?php echo url_for('/usuario/index.php');?>">
            <i class="fas fa-angle-double-left"></i> Regresar a usuarios
        </a>
    </p>

    <section class="info">
        <?php $subject = find_usuario_by_id($usuario['id']); ?>    
         <?php $organizacion = find_organizacion_by_id($usuario['organizacion']); ?>
         <?php $tipo_usuario = find_tipo_usuario_by_id($usuario['tipo_usuario']); ?>

        <center><h2 class="bold top-space bottom-space"><?php echo strtoupper(h($usuario['nombre_usuario']));?></h2></center>
        <table class="table center-text">

<table data-role="table" id="table-column-toggle"  class="ui-responsive table-stroke">
     <thead>
       <tr>
         <th data-priority="1">Id:</th>
         <th data-priority="2">Usuario:</th>
         <th data-priority="3">Nombre:</th>
         <th data-priority="4">Genero:</th>
         <th data-priority="5">Nacimiento:</th>
         <th data-priority="6">Correo:</th>
         <th data-priority="7">Contraseña:</th>
         <th data-priority="8">Tipo Usuario:</th>
         <th data-priority="9">Activo</th>
         <th data-priority="10">Organización</th>
         
       </tr>
     </thead>
     <tbody>
       <tr>
         <td><?php echo h($usuario['id']);?></td>
         <td><?php echo h($usuario['nombre_usuario']);?></td>
         <td><?php echo h($usuario['primer_nombre']);echo " " ;echo h($usuario['segundo_nombre']); echo " " ;echo h($usuario['primer_apellido']); echo " " ;echo h($usuario['segundo_apellido']);?></td>
         <td><?php echo $usuario['genero'] == 'M' ? 'Masculino':'Femenino';?></td>
         <td><?php echo h($usuario['fecha_nacimiento']);?></td>
         <td><?php echo h($usuario['correo_electronico']);?></td>
         <td><?php echo h($usuario['contrasena']);?></td>
         <td><?php echo h($tipo_usuario['nombre']);?></td>
         <td><?php echo $usuario['activo'] == 1 ? 'Sí':'No'; ?></td>
         <td><?php echo h($organizacion['nombre']);?></td>
         
       </tr>
     
     </tbody>
  
    </section>
</section>
