<?php
/*Modelo que servira para la tabla de candidatos(usuario) y para la tabla de empresas*/
class Modelo_Usuario{

  public static function existeCorreo($correo){
    if(empty($correo)){ return false; }
    $nulo = array();
    $sql = "SELECT * FROM mfo_preregistro WHERE correo = '".$correo."'";
    $rs = $GLOBALS['db']->auto_array($sql,array($correo));
    return (empty($rs['correo'])) ? $nulo : $rs;
  }

  public static function existeDni($dni){
    if(empty($dni)){ return false; }
    $nulo = array();
    $sql = "SELECT * FROM mfo_preregistro WHERE dni = ".$dni;
    $rs = $GLOBALS['db']->auto_array($sql,array());
    return (empty($rs['dni'])) ? $nulo : $rs;
  }

   public static function guardarUsuario($data){
    if(!is_array($data) || empty($data)){return false;}
      $result = $GLOBALS['db']->insert('mfo_preregistro', $data);
      return $result;
   }

}  
?>