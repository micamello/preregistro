<?php
class Vista {
  
  public static function render($pagina, $template_vars = array(),$cabecera='cabecera', $piepagina='piepagina',$deshabilitarmenu=''){
    if (!empty($template_vars))
        extract($template_vars);
      
    $sess_err_msg = self::obtieneMsgError();
    $sess_suc_msg = self::obtieneMsgExito();    
    if( !$sess_err_msg ){
      $sess_err_msg = '';
    }
    if (!$sess_suc_msg){
      $sess_suc_msg = '';
    } 
    ob_start();

    if (!empty ($cabecera)){      
      require RUTA_VISTA . "html/". $cabecera . '.php';
    }

    $ruta = RUTA_VISTA . "html/". $pagina . '.php';
    if( file_exists($ruta) ){
        require $ruta;       
    }    
    else{
        echo 'Esta pagina no existe : '. $pagina;  
    }
    if (!empty($piepagina)){
      require RUTA_VISTA . "html/" . $piepagina . '.php';
    }    
    ob_end_flush();
  }

  public static function display($pagina, $template_vars = array()){    
    if (!empty($template_vars))
        extract($template_vars);
    
    ob_start();

    $ruta = RUTA_VISTA . "html/". $pagina . '.php';
    if( file_exists($ruta) ){
        require $ruta;       
    }    
    else{
        echo 'Esta pagina no existe : '. $pagina;  
    }
        
    $to_return = ob_get_clean();
    return $to_return;
  }
  
  private static function obtieneMsgError(){
    $msg = "";
    if( isset($_SESSION['mostrar_error']) && !empty($_SESSION['mostrar_error']) ){
      $msg = $_SESSION['mostrar_error'];
      $msg = str_replace (array("\r\n", "\n", "\r"), '', $msg);
      $msg = htmlentities($msg, ENT_QUOTES, 'UTF-8');
      unset($_SESSION['mostrar_error']);
    }
    return $msg;
  }
  
  private static function obtieneMsgExito(){
    $msg = "";
    if( isset($_SESSION['mostrar_exito']) && !empty($_SESSION['mostrar_exito']) ){
      $msg = $_SESSION['mostrar_exito'];
      $msg = str_replace (array("\r\n", "\n", "\r"), '', $msg);
      $msg = htmlentities($msg, ENT_QUOTES, 'UTF-8');
      unset($_SESSION['mostrar_exito']);
    }
    return $msg;
  }  

  public static function renderJSON($template_vars=array()){
    array_walk_recursive($template_vars, function(&$item){
          $item = utf8_encode($item); 
    });
    echo json_encode($template_vars);
  }

}
?>