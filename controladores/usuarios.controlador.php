<?php
class ControladorUsuarios
{
    public static function ctrIngresoUsuario()
    {
        if (isset($_POST['ingUsuario'])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])
            ) {
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $tabla = 'usuarios';
                $item = 'usuario';
                $valor = $_POST['ingUsuario'];
                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
                if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {
                    if ($respuesta["estado"] == 1) {
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];
                        $_SESSION["foto"] = $respuesta["foto"];
                        $_SESSION["perfil"] = $respuesta["perfil"];
                        /*=============================================
                        REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                        =============================================*/
                        date_default_timezone_set('America/Mexico_City');
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $fechaActual = $fecha . ' ' . $hora;
                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;
                        $item2 = "id";
                        $valor2 = $respuesta["id"];
                        $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
                        if ($ultimoLogin == "ok") {
                            echo '<script>  
								window.location = "inicio";
                                
							</script>';
                        }
                    } else {
                        echo '
                            <script>
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                  toast.addEventListener("mouseenter", Swal.stopTimer)
                                  toast.addEventListener("mouseleave", Swal.resumeTimer)
                                }
                              })
                              
                              Toast.fire({
                                icon: "error",
                                title: "El usuario aún no está activado"
                              })
                            </script>
                            ';
                    }
                } else {
                    echo '
                    <script>
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                  toast.addEventListener("mouseenter", Swal.stopTimer)
                                  toast.addEventListener("mouseleave", Swal.resumeTimer)
                                }
                              })
                              
                              Toast.fire({
                                icon: "error",
                                title: "Error al ingresar, vuelve a intentarlo"
                              })
                            </script>
                    ';
                }
            }
        }
    }
    // Registro Usuario
    public static function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoNombre"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
            ) {
                $tabla = "usuarios";
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos = array("nombre" => $_POST["nuevoNombre"], "usuario" => $_POST["nuevoUsuario"], "password" => $encriptar, "perfil" => $_POST["nuevoPerfil"]);
                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
					Swal.fire({
						icon: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "usuarios";
						}
					});
				
				</script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                        icon: "error",
						title: "¡El usuario no puede llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "usuarios";
						}
					});
				</script>';
            }
        }
    }

    public static function ctrMostrarUsuarios($item, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }
    // Editar Usuario
    public static function ctrEditarUsuario()
    {
        if (isset($_POST["editarUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
                $tabla = "usuarios";
                if ($_POST["editarPassword"] != "") {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        echo '<script>
                        Swal.fire({
                            icon: "error",
									  title: "¡La contraseña no puede llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {
										window.location = "usuarios";
										}
									})
						  	</script>';
                    }
                } else {
                    $encriptar = $_POST["passwordActual"];
                }
                $datos = array(
                    "nombre" => $_POST["editarNombre"],
                    "usuario" => $_POST["editarUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["editarPerfil"],
                );
                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
					Swal.fire({
                        icon: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "usuarios";
									}
								})
					</script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
						  title: "¡El nombre no puede llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "usuarios";
							}
						})
			  	</script>';
            }
        }
    }
    public static function ctrBorrarUsuario()
    {
        if (isset($_GET["idUsuario"])) {
            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>

				Swal.fire({
                    icon: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';
            }
        }
    }
}
