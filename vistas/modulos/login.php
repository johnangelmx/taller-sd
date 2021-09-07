<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

    .pop {
        font-family: 'Poppins', sans-serif;
    }
</style>
<?php error_reporting(0); ?>
<div class="login-box pop">
    <div class="login-logo">
        <img src="vistas/img/car.png" class="img-responsive" style="width: 400px; height:200px">
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingresar Sus Credenciales</p>
        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row ">
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4 center-block">
                        <button type="submit" class="btn btn-black btn-block btn-flat" style="border: 1px solid">Ingresar</button>
                    </div>
                </div>
            </div>
            <?php
            $login = new ControladorUsuarios();
            $login->ctrIngresoUsuario();
            ?>
        </form>
    </div>
</div>