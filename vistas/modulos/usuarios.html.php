<!-- =============================================== 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
-->
  <!--  =================================================
        PLUGIN DE JAVASCRIPT PARA VENTANA MODAL / PLANTILLA.PHP
   =================================================- -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
        <small>Usuarios</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="usuarios"><?php echo $_GET['ruta'];?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
              <button class="bnt btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar usuario</button>
        </div>

        <!-- ==== Tabla de Usuarios ==== -->
        <div class="box-body">
          <table class="table table-bordered table-striped datatable dt-responsive">
            <thead>
              <tr>
                <th>#Reg</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>1</td>
                <td>Usuario >Administrador</td>
                <td>admin</td>
                <td>Ruta Foto</td>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activo</button></td>
                <td>12/07/2023</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>&nbsp;
                    <button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                </td>
              </tr>
            </tbody>
            
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- =============MODAL PARA AGREGAR USUARIOS ======-->

<!--====== Ventana Modal ======-->

  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
      
      <!-- contenido del modal -->
    <div class="modal-content">

    <form method="post" role="form" enctype="multipart/form-data">
        
    <!-- ===== Header del Modal =====-->
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar usuarios</h4>      
      </div>
    <!-- ===== Body del Modal =====-->
      <div class="modal-body">
   
        <div class="box-body">

          <!--=== ENTRADA PARA EL NOMBRE ===-->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-pencil"></i> </span>
              <input type="text" class="form-control input-sm" name="nuevoNombre" placeholder="Ingresar nombre" required>
            </div> 
          </div>

          <!--=== ENTRADA PARA EL USUARIO ===-->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i> </span>
              <input type="text" class="form-control input-sm" name="nuevoUsuario" placeholder="Ingresar nombre" required>
            </div> 
          </div>

          <!--=== ENTRADA PARA EL PASSWORD ===-->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i> </span>
              <input type="password" class="form-control input-sm" name="nuevoPassword" placeholder="Ingresar Contraseña" required>
            </div> 
          </div>

           <!--=== ENTRADA PARA SELECCIONAR EL PERFIL DE USUARIO ===-->
          <div class="form-group">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-users"></i> </span>
              <select class="form-control input-sm" name="nuevoPerfil">
                <option value="">Seleccionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div> 
          </div>

          <!--=== SUBIR FOTO DE USUARIO ===-->
          <div class="form-group">
            <div class="panel text-capitalize">
              <input type="file" id="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso de la foto: 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" alt="Foto usuario">
            </div> 
          </div>          

        </div>
   
      </div>

      <!-- ===== Footer del Formulario =====-->
      <div class="modal-footer">
        <button type="button" class="btn-danger btn-sm btn-" data-dismiss="modal" style="align-self: left;">Cerrar</button> 
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button> 
      </div>

      <!-- Instanciamos la Clase y llamado a funcin para crear el Usuario en la BD -->
      <?php 
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();
       ?>
      </form>  <!-- === Cierre del Formulario ===-->

    </div>
      
  </div>
  </div>