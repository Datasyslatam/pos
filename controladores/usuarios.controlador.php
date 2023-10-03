<?php

/*====================================
	Clase para control de Usuarios 
=======================================*/
class ControladorUsuarios{

	//============ Metodo para Control y Validacion de Ingreso Usuarios al Sistema =========
	static public function ctrIngresoUsuario(){		// Controlador de Ingreso de Usuarios
		if (isset($_POST["ingUsuario"])) {
			// code...
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
			   	
				$tabla = "usuarios";		// Solicitar consultar ela Tabla.....$tabla
				$campo_tbl = "usuario";			// Consultar la Columna o Campo....$campo_tbl
				$valor = $_POST["ingUsuario"];	// El siguiente Valor que viene por $_POST....$valor
			   	$pass_encriptado = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				// Hacemos llamado al Modelo de Usuarios "usuarios.modelos.php" Con datos de Consulta
				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo_tbl, $valor);	// Respuesta obtenida de la varaiable $stmt de Modelo de Usuarios
				//var_export($respuesta);	// Muestra Array con valor de la Fila, obtenido solo valor

				//var_dump($respuesta["usuario"]);	// Muestra el resultado en Array obtenido con Posiscion, Tipo y valor de Variables o solo la Columna "usuario

				if ($respuesta["usuario"] != $_POST["ingUsuario"]){
					echo "<br><div class='alert alert-danger'>Error.! Nombre de usuario no registrado.</div>";
				}else{

					if (($respuesta["usuario"] == $_POST["ingUsuario"]) && ($respuesta["password"] == $pass_encriptado)) {
						//echo "<br><div class='alert alert-success'>Exito.! Usuario registrado en el sistema</div>";

						$_SESSION['iniciosession'] = 'ok';
						$_SESSION["id"]            = $respuesta["id"];
						$_SESSION["nombre"]        = $respuesta["nombre"];
						$_SESSION["usuario"]       = $respuesta["usuario"];
						$_SESSION["foto"]          = $respuesta["foto"];
						$_SESSION["perfil"]        = $respuesta["perfil"];
						
						echo '<script> 
							window.location = "inicio";
						</script>';

					}else{
						echo "<br><div class='alert alert-danger'>Error.! Usuario no registrado en el sistema.</div>";
					}
				}

			}
		}

	}

	/*==========================================
	Metodo para Registro o Creacion de Usuario 
	============================================= */

	static public function ctrCrearUsuario(){
	
		if(isset($_POST["nuevoUsuario"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

			   	/*=============================================
					VALIDAR IMAGEN DE USUARIO
				=============================================*/
				$ruta = "vistas/img/usuarios/default/anonymous.png";
				//if(isset($_FILES["nuevaFoto"]["tmp_name"])){

				if($_FILES['nuevaFoto']['name'] != ""){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 300;
					$nuevoAlto = 300;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						// Le agregamos el Nombre de Usuario a traves de Var POST al nombre de la Foto + Nro Aleatorio
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$_POST["nuevoUsuario"].$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						// Le agregamos el Nombre de Usuario a traves de Var POST al nombre de la Foto + Nro Aleatorio
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$_POST["nuevoUsuario"].$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";
				$pass_encriptado = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $pass_encriptado,
					           "perfil" => $_POST["nuevoPerfil"],
					           "foto" => $ruta,
							   "estado" => "1");

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos); // Enviamos nombre de Tabla y Arreglo de Datos al Modelo para su Insercion en la BD
			
				if($respuesta == "ok"){
					echo '<script>
					swal({
						type: "success",
						title: "¡El usuario ha sido guardado exitosamente.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "usuarios";
						}
					});
				
					</script>';
				}else{
					echo '<script>
					swal({
						type: "error",
						title: "¡El usuario no pudo crearse.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then(function(result) {
						if(result.value){
						
							window.location = "usuarios";
						}
					});
					</script>';
				}

			}else{
				echo '<script>
					swal({
						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then(function(result) {
						if(result.value){
						
							window.location = "usuarios";
						}
					});
				
				</script>';
			}
		}
	}

	/*================================================
	Metodo para Listar Usuario en DataTable Usuarios
	=================================================== */

	static public function ctrMostrarUsuarios($campo_tbl, $valor){
	
		$tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo_tbl, $valor);	// Respuesta obtenida de la varaiable $connde Modelo de Usuarios
        return $respuesta;

	}
}

?>