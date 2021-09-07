<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrador De Clientes
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
                <button class="btn btn-default bc" data-toggle="modal" data-target="#modalAgregarCliente"> Agregar Usuario</button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th style="width:20px">Fecha De Nacimiento</th>
                            <th style="width:15px">Total De Compras</th>
                            <th>Ultima Compra</th>
                            <th>Ingreso Al sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                        foreach ($clientes as $key => $value) {
                            echo '<tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["nombre"] . '</td>
                    <td>' . $value["email"] . '</td>
                    <td>' . $value["telefono"] . '</td>
                    <td>' . $value["direccion"] . '</td>
                    <td>' . $value["fecha_nacimiento"] . '</td>             
                    <td>' . $value["compras"] . '</td>
                    <td>' . $value["ultima_compra"] . '</td>
                    <td>' . $value["fecha"] . '</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                      </div>  
          </td>
        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class=" modal fade" id="modalAgregarCliente" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header bc">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="bc" aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="nuevoCliente" placeholder="Ingresar Nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="nuevoEmail" placeholder="Ingresar Email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" name="nuevoTelefono" placeholder="Ingresar Telefono" class="form-control" data-inputmask="'mask': '(999) 999-9999'" data-mask required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="nuevaDireccion" placeholder="Ingresar Direccion" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" placeholder="Año/mes/dia" name="nuevaFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left bc" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-default">Guardar Cliente</button>
                </div>
            </form>
            <?php
            $crearCliente = new ControladorClientes();
            $crearCliente->ctrCrearCliente();
            ?>
        </div>
    </div>
</div>
<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
                <div class="modal-header bc"">
                    <button type=" button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar cliente</h4>
                </div>
                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                                <input type="hidden" id="idCliente" name="idCliente">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL EMAIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL TELÉFONO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA DIRECCIÓN -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=====================================
        PIE DEL MODAL
        ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left bc" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-default">Guardar cambios</button>
                </div>
            </form>
            <?php
            $editarCliente = new ControladorClientes();
            $editarCliente->ctrEditarCliente();
            ?>
        </div>
    </div>
</div>
<?php
$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();
?>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })

    function mostrarContrasena() {
        var tipo = document.getElementById("password");
        if (tipo.type == "password") {
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()
</script>