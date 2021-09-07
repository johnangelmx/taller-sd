<link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.css">
<link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.print.css" media="print">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bienvenido <?php echo $_SESSION["nombre"] ?>
            <small>Panel de control</small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Vista General Del Sistema </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7">
                        <div id="div1">
                            <p id="time" style="display: inline"></p>
                            <p id="date" style="margin-left: 10px; display: inline; "></p>
                        </div>
                        <div class="col-md-6" style="padding: 10px 5px;">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Servicios Realizados</span>
                                    <?php
                                    require_once "modelos/conexion.php";
                                    $stmt = conexion::conectar()->prepare("SELECT SUM(compras) FROM clientes");
                                    $stmt->execute();
                                    $results = $stmt->fetch();
                                    echo
                                    '<span class="info-box-number" style="font-size: 32px;">' . $results[0] . '</span>';
                                    ?>

                                    <div class="progress">
                                    </div>
                                    <span class="progress-description">
                                        
                                    </span>
                                </div>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="col-md-6" style="padding:10px 5px;">
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Empleados</span>
                                    <?php
                                    require_once "modelos/conexion.php";
                                    $stmt = conexion::conectar()->prepare("SELECT SUM(total) FROM ventas");
                                    $stmt = conexion::conectar()->prepare("SELECT COUNT(id) FROM usuarios");
                                    $stmt->execute();
                                    $results = $stmt->fetch();
                                    echo
                                    '<span class="info-box-number" style="font-size: 32px;">' . $results[0] . '</span>';
                                    ?>
                                    <div class="progress">
                                    </div>
                                    <span class="progress-description">
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div>
                            <img src="vistas/img/car.png" class="img-responsive" style="width: 600px; height:300px">

                        </div>
                    </div>
                    <div class="col-md-5 calendario">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    @import 'https://fonts.googleapis.com/css?family=Nova+Mono|Eczar';

    .calendario {
        display: inline;
        border-radius: 50px;
        background: #ffffff;
        box-shadow: 20px 20px 60px #bababa,
            -20px -20px 60px #ffffff;
    }

    #time {
        font-family: 'Nova Mono', monospace;
        font-size: 3vw;
        text-align: left;
        text-shadow: 0px 0px 30px #222d32;
    }

    #date {
        font-family: 'Eczar', serif;
        font-size: 2vmin;
        text-align: left;
        color: #222d32;
    }

    @media only screen and (max-width: 500px) {
        #time {
            font-size: 2em;
        }

        #date {
            font-size: 1em;
        }
    }
</style>
<script>
    window.setInterval(ut, 1000);

    function ut() {
        var d = new Date();
        document.getElementById("time").innerHTML = d.toLocaleTimeString();
        document.getElementById("date").innerHTML = d.toLocaleDateString();
    }
</script>
<script src="vistas/bower_components/moment/moment.js"></script>
<script src="vistas/bower_components/fullcalendar/dist/fullcalendar.js"></script>
<script>
    $(function() {
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Dia'
            },
        })
    })
</script>