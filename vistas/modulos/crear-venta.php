<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Crear venta
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Crear venta</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <!--=====================================
      EL FORMULARIO
      ======================================-->
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border"></div>
                    <form role="form" method="post" class="formularioVenta">
                        <div class="box-body">
                            <div class="box">
                                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                                        <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                                    </div>
                                </div>
                                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                                        if (!$ventas) {
                                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                                        } else {
                                            foreach ($ventas as $key => $value) {
                                            }
                                            $codigo = $value["codigo"] + 1;
                                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="' . $codigo . '" readonly>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                                            <option value="">Seleccionar cliente</option>
                                            <?php
                                            $item = null;
                                            $valor = null;
                                            $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);
                                            foreach ($categorias as $key => $value) {
                                                echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                                    </div>
                                </div>
                                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->
                                <div class="form-group row nuevoProducto">
                                </div>
                                <input type="hidden" id="listaProductos" name="listaProductos">
                                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->
                                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                                <hr>
                                <div class="row">
                                    <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                                    <div class="col-xs-8 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
                                                            <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                                                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>
                                                            <input type="hidden" name="totalVenta" id="totalVenta">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
                                <div class="form-group row">
                                    <div class="col-xs-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                <option value="">Seleccione método de pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="TC">Tarjeta Crédito</option>
                                                <option value="TD">Tarjeta Débito</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cajasMetodoPago"></div>
                                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
                        </div>
                    </form>
                    <?php
                    $guardarVenta = new ControladorVentas();
                    $guardarVenta->ctrCrearVenta();
                    ?>
                </div>
            </div>
            <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive tablaVentas">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Imagen</th>
                                    <th>Código</th>
                                    <th>Descripcion</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->
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