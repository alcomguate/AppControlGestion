<?php
require_once('../../private/initialize.php');




if (!isset($_GET['id'])) {
  redirect_to(url_for('/usuario/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $usuario = [];
    $usuario['id'] = $id;
    $usuario['nombre_usuario'] = $_POST['nombre_usuario'] ?? '';
    $usuario['primer_nombre'] = $_POST['primer_nombre'] ?? '';
    $usuario['segundo_nombre'] = $_POST['segundo_nombre'] ?? '';
    $usuario['primer_apellido'] = $_POST['primer_apellido'] ?? '';
    $usuario['segundo_apellido'] = $_POST['segundo_apellido'] ?? '';
    $usuario['genero'] = $_POST['genero'] ?? '';
    $usuario['fecha_nacimiento'] = $_POST['fecha_nacimiento'] ?? '';
    $usuario['correo_electronico'] = $_POST['correo_electronico'] ?? '';
    $usuario['contrasena'] = $_POST['contrasena'] ?? '';
    $usuario['tipo_usuario'] = $_POST['tipo_usuario'] ?? '';
    $usuario['activo'] = $_POST['activo'] ?? '';
    $usuario['organizacion'] = $_POST['organizacion'] ?? '';
    $result = update_usuario($usuario);
    if ($result === true) {
        redirect_to(url_for('/usuario/index.php'));
    } else {
        $errors = $result;
    }
} else {
    $usuario = find_usuario_by_id($id);
   
}
$usuario_set = get_all_usuario();
$usuario_count = mysqli_num_rows($usuario_set);    
mysqli_free_result($usuario_set);
?>

<?php $categoria_title = 'Editar Usuario';?>

<div data-role="page">
    <div data-role="header" data-theme="a">
        <h1>Usuarios</h1>
    </div>
    <div data-role="content">
<section>
    <p class="top-space">
        <a class="btn btn-info" href="<?php echo url_for('/usuario/index.php');?>">   
            <i class="fas fa-angle-double-left"></i> Regresar a usuarios
        </a>
    </p>
    <section class="forms">
        <h3 class="bold top-space">¿Editar <?php echo strtoupper(h($usuario['nombre_usuario']));?>?</h3>
        <?php echo display_errors($errors);?>
        <form action="<?php echo url_for('/usuario/edit.php?id=' . h(u($id))); ?>" method="post">
            <label>Usuario:</label>
            <input type="text" name="nombre_usuario" id="txt_titulo" required value="<?php echo h($usuario['nombre_usuario'])?>">

            <label>Primer Nombre:</label>
            <input type="text" name="primer_nombre" id="txt_titulo" required value="<?php echo h($usuario['primer_nombre'])?>">

            <label>Segundo Nombre:</label>
            <input type="text" name="segundo_nombre" id="txt_titulo" required value="<?php echo h($usuario['segundo_nombre'])?>">

            <label>Primer Apellido:</label>
            <input type="text" name="primer_apellido" id="txt_titulo" required value="<?php echo h($usuario['primer_apellido'])?>">

            <label>Segundo Apellido:</label>
            <input type="text" name="segundo_apellido" id="txt_titulo" required value="<?php echo h($usuario['segundo_apellido'])?>">

            <label for="password">Contraseña:</label>
            <input type="password" name="contrasena" id="password" autocomplete="off" value="<?php echo h($usuario['contrasena'])?>">
            

           
            <label for="cbx_genero" class="select">Genero:</label>

            <select name="genero">
                    <?php
                        
                        echo "<option value=\"" . h($usuario['genero']) . "\"";
                        if($usuario["genero"] == $usuario['genero']) {
                            echo " selected";
                        }
                        echo ">" . h($usuario['genero']) . "</option>";
                        echo "<option value='M'>Masculino</option>";
                        echo "<option value='M'>Femenino</option>";
                       
                    ?>
            </select>





            <label for="date">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="date" value="<?php echo h($usuario['fecha_nacimiento'])?>">

            <label>Correo Electronico</label>
            <input type="text" name="correo_electronico" id="txt_titulo" required value="<?php echo h($usuario['correo_electronico'])?>">


            <select name="tipo_usuario">
                    <?php
                        $tipo_usuario_set = get_all_tipo_usuario();
                        while($tipo_usuario= mysqli_fetch_assoc($tipo_usuario_set)) {
                        echo "<option value=\"" . h($tipo_usuario['id']) . "\"";
                        if($tipo_usuario["id"] == $tipo_usuario['id']) {
                            echo " selected";
                        }
                        echo ">" . h($tipo_usuario['nombre']) . "</option>";
                        }
                        mysqli_free_result($tipo_usuario_set);
                    ?>
            </select>


            <dl>
                <dt>Estado: &nbsp;&nbsp;  
                     <label>
                    <input type="hidden" name="activo" value="0" />
                    <input type="checkbox" name="activo" value="1"<?php if($usuario['activo'] == "1") { echo " checked"; } ?> />
                    </label>
                </dt>
      
            </dl>

            
            <select name="organizacion">
                    <?php
                        $organizacion_set = get_all_organization();
                        while($organizacion= mysqli_fetch_assoc($organizacion_set)) {
                        echo "<option value=\"" . h($organizacion['id']) . "\"";
                        if($organizacion["id"] == $organizacion['id']) {
                            echo " selected";
                        }
                        echo ">" . h($organizacion['nombre']) . "</option>";
                        }
                        mysqli_free_result($organizacion_set);
                    ?>
            </select>
          

            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Editar Usuario">
        </form>
    </section>
    <p class="white-space"></p>
</section>

