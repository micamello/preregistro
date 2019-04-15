<?php
class Modelo_Genero{

	public static function consulta(){
		$sql = "SELECT * FROM mfo_genero";
		return $GLOBALS['db']->auto_array($sql,array(),true);
	}
}
?>