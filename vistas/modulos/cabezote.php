<header class="main-header">
    <a href="inicio" class="logo">
        <span class="logo-mini"><b>T</b>SD</span>
        <span class="logo-lg"><b>Taller|</b><em>Santo Domingo</em></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $_SESSION["nombre"] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <!-- <div class="col-md-4 center-block">
                                <a href="#" class="btn btn-info">Cerra Sesion</a>
                            </div> -->
                            <div class="row ">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="singlebutton"></label>
                                    <div class="col-md-4 center-block">
                                        <a href="salir" class="btn btn-default with-border">Cerra Sesion</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>