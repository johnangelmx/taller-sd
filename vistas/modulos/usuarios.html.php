<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrador De Usuarios
      <small>Panel de control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="usuarios">Administracion De Usuario</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-default bc" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Usuario</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width:30px"">#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Ultimo Login</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Usuario Administrador</td>
                            <td>admin</td>
                            <td>Administrador</td>
                            <td><button class=" btn btn-success btn-xs">Activado</button></td>
              <td>2019-12-11</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
            </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="modalAgregarUsuario" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header bc">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="bc" aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="nuevoNombre" placeholder="Ingresar Nombre" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" name="nuevoUsuario" placeholder="Ingresar Usuario" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="nuevoPassword" placeholder="Ingresar Contraseña" class="form-control" id="password" required>
                <span class="input-group-addon btn btn-primary" type="button" onclick="mostrarContrasena()"><i class="fa fa-eye" aria-hidden="true"></i></span>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control" name="nuevoPerfil" required>
                  <option value="" disabled selected hidden>Seleccionar Perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Empleado">Empleado</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left bc" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Guardar Usuario</button>
        </div>
        <?php
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();
        ?>
      </form>
    </div>
  </div>
</div>
<script>
  function mostrarContrasena() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
      tipo.type = "text";
    } else {
      tipo.type = "password";
    }
  }
</script>