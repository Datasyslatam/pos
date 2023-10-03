<?php

/**
 * 
 */
class Conexion {
	
	public static function conectar()	{
		// code...
		$conn = new PDO("mysql:host=localhost; dbname=beltaplus", "root", ""); // Variable de conexion al Servidor

		//Validar que los datos que vienen en caracteres Latinos se evaluen sn problemas
		$conn->exec("set names utf8");	
		return $conn;
	}
}