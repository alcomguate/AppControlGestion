<?php include_once '../../private/initialize.php'?>
 <?php $page_title = 'Nuevo Usuario';?>

<?php 

  
    if (is_post_request()) {
        $usuario_nuevo = [];
        $usuario_nuevo['nombre_usuario'] = $_POST['nombre_usuario'];
        $usuario_nuevo['primer_nombre'] = $_POST['primer_nombre'];
        $usuario_nuevo['segundo_nombre'] = $_POST['segundo_nombre'];
        $usuario_nuevo['primer_apellido'] = $_POST['primer_apellido'];
        $usuario_nuevo['segundo_apellido'] = $_POST['segundo_apellido'];
        $usuario_nuevo['genero'] = $_POST['genero'];
        $usuario_nuevo['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
        $usuario_nuevo['correo_electronico'] = $_POST['correo_electronico'];
        $usuario_nuevo['contrasena'] = $_POST['contrasena'];
        $usuario_nuevo['tipo_usuario'] = $_POST['tipo_usuario'];
        $usuario_nuevo['activo'] = $_POST['activo'];
        $usuario_nuevo['organizacion'] = $_POST['organizacion'];
    


        $result = insert_usuario($usuario_nuevo);


        if ($result === true) {
            $new_id = mysqli_insert_id($db);
            redirect_to(url_for('/usuario/index.php'));
        } else {
            $errors = $result;
        }

    }

    $option = [];
    $option['activo'] = 'true';
    $organizacion_set = get_all_organization($option);
    $tipo_usuario_set = get_all_tipo_usuario($option);

?>

<div data-role="page">
    <div data-role="header" data-theme="b">
        <h1>Control de gestiones</h1>
    </div>
    <div data-role="content">
 <p class="top-space">
    <h3>Usuarios</h3>
        <a class="btn btn-info" href="<?php echo url_for('usuario/index.php');?>">   
            <i class="fas fa-angle-double-left"></i> Regresar a usuarios
        </a>
    </p>
        <form action="<?php echo url_for('usuario/new.php'); ?>" method="post">

            <label>Usuario:</label>
            <input type="text" name="nombre_usuario" id="txt_titulo" required>

            <label>Primer Nombre:</label>
            <input type="text" name="primer_nombre" id="txt_titulo" required>

            <label>Segundo Nombre:</label>
            <input type="text" name="segundo_nombre" id="txt_titulo" required>

            <label>Primer Apellido:</label>
            <input type="text" name="primer_apellido" id="txt_titulo" required>

            <label>Segundo Apellido:</label>
            <input type="text" name="segundo_apellido" id="txt_titulo" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="contrasena" id="password" autocomplete="off">
            

           
            <label for="cbx_genero" class="select">Genero:</label>
            <select name="genero" id="cbx_genero">
                <option value="M">Masculino</option>

                <option value="F">Femenino</option>                
            </select>

            <label for="date">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="date" value="">

            <label>Correo Electronico</label>
            <input type="text" name="correo_electronico" id="txt_titulo" required>


            <label for="cbx_tipo_usuario" class="select">Tipo de Usuario:</label>
            <select name="tipo_usuario" id="cbx_tipo_usuario">
            <?php while ($tipo_usuario = mysqli_fetch_assoc($tipo_usuario_set)) {?>
                <option value="<?php echo $tipo_usuario['id']?>">
                    <?php echo $tipo_usuario['nombre']?>
                </option>
            <?php } ?>
            </select>


            <dl>
                <dt>Estado: &nbsp;&nbsp;  
                    
                    <input type="hidden" name="activo" value="0" />
                    <label>
                    <input type="checkbox" name="activo" value="1" checked="true" />
                    </label>
                </dt>
      
            </dl>

            <label for="cbx_categoria" class="select">Organización:</label>
            <select name="organizacion" id="cbx_categoria">
            <?php while ($organizacion = mysqli_fetch_assoc($organizacion_set)) {?>
                <option value="<?php echo $organizacion['id']?>">
                    <?php echo $organizacion['nombre']?>
                </option>
            <?php } ?>
            </select>

          

            <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b" 
                    value="Crear Usuario">
        </form>
    </div>
</div>

