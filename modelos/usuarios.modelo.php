<?php

require_once "conexion.php";

class ModeloUsuarios{

/*========================================== 
	Mostrar usuarios consultados a la DB 
	=========================================*/
	public static function mdlMostrarUsuarios($tabla, $campo_tbl, $valor){

		if(($campo_tbl != null) || ($valor != null)){	// Validamos para verificar si es por ingreso de Login o Consulta total de usuarios

			$conn = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $campo_tbl = :$campo_tbl"); // Parametro a enlazar
			$conn -> bindParam(":".$campo_tbl, $valor, PDO::PARAM_STR); // enlace del parametro
			$conn -> execute();
			return $conn->fetch();		// Retornamos con una Fila de la Consulta a la Tabla al Controlador de usuarios

		}else{

			$conn = Conexion::conectar()->prepare("SELECT * FROM $tabla"); 
			$conn -> execute();
			return $conn->fetchall();		// Retornamos todas las Filas de la Consulta a la Tabla al Controlador de ctrMostrarUsuarios
		}

		$conn -> close();
		$conn -> null;
	}

/*====================================== 
	Guardar usuarios nuevos a la DB 
	=====================================*/
	static public function mdlIngresarUsuario($tabla, $datos){

		$conn = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto, estado) VALUES(:nombre, :usuario, :password, :perfil, :foto, :estado)"); // Guardar en tabla "usuarios"

		$conn -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR); // enlace del parametro
		$conn -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR); 
		$conn -> bindParam(":password", $datos["password"], PDO::PARAM_STR); 
		$conn -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$conn -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$conn -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR); 
		
		if ($conn -> execute()) {
			return "ok";
		}else { 
				return "error";
		}

		$conn -> close();
		$conn -> null;
	}

}