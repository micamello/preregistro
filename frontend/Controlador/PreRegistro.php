<?php
class Controlador_PreRegistro extends Controlador_Base {
  
  public function construirPagina(){  

  	$opcion = Utils::getParam('opcion','',$this->data);
  	switch($opcion){
      case 'buscarDni':
        $dni = Utils::getParam('dni', '', $this->data);
        $buscardni = Modelo_Usuario::existeDni($dni);
        Vista::renderJSON($buscardni);
      break;
      case 'buscarCorreo':
        $correo = Utils::getParam('correo', '', $this->data);
        $buscarcorreo = Modelo_Usuario::existeCorreo($correo);
        Vista::renderJSON($buscarcorreo);
      break;
      case 'guardardatos':
        self::proceso();
      break;
      default:
        self::defaultScreen();
      break;
    }    
  }

  public function proceso(){
    $tipo_usuario = Utils::getParam('tipo_usuario');    
    try {
      if ( Utils::getParam('form_pre') == 1 ){
        if($tipo_usuario == 1){
          $campos = array('nombre'=>1, 'apellidos'=>1, 'tipo_doc'=>1, 'documento'=>1, 'telefono'=>1, 
                          'correo'=>1, 'tipo_usuario'=>1, 'fecha_nacimiento'=>1, 'id_genero'=>1, 'term_cond'=>1); 
        }else{
          $campos = array('nombre'=>1, 'tipo_doc'=>1, 'documento'=>1, 'telefono'=>1, 'correo'=>1, 'tipo_usuario'=>1, 'term_cond'=>1); 
        }
        $data = $this->camposRequeridos($campos);
        self::validarTipoDato($data);
        self::guadarRegistro($data);
        $_SESSION['mostrar_exito'] = "Se ha registrado correctamente";
      }
    } catch (Exception $e) {
      //echo $e->getMessage();
      $_SESSION['mostrar_error'] = $e->getMessage();
    }
    Utils::doRedirect(PUERTO.'://'.HOST.'/');
  }

  public function guadarRegistro($data){
    $fecha = date("Y-m-d H:i:s");
    $datos_usuario = array();
    if($data['tipo_usuario'] == 1){
      $datos_usuario = array('nombres'=>$data['nombre'], 
                              'apellidos'=>$data['apellidos'], 
                              'correo'=>$data['correo'], 
                              'tipo_doc'=>$data['tipo_doc'], 
                              'dni'=>$data['documento'], 
                              'telefono'=>$data['telefono'], 
                              'fecha'=>$fecha,
                              'tipo_usuario'=>$data['tipo_usuario'],
                              'fecha_nacimiento'=>$data['fecha_nacimiento'],
                              'id_genero'=>$data['id_genero'],
                              'term_cond'=>1);
    }
    else{
      $datos_usuario = array('nombres'=>$data['nombre'],
                              'correo'=>$data['correo'], 
                              'tipo_doc'=>$data['tipo_doc'], 
                              'dni'=>$data['documento'], 
                              'telefono'=>$data['telefono'], 
                              'fecha'=>$fecha,
                              'tipo_usuario'=>$data['tipo_usuario'],
                              'term_cond'=>1);
    }
    //$_SESSION['mensaje'] = "";
    if(!Modelo_Usuario::guardarUsuario($datos_usuario)){
      //$_SESSION['mensaje'] = 0;
      throw new Exception("Ha ocurrido un error, intente nuevamente en un momento");
    }
    //$_SESSION['mensaje'] = 1;
  }

  public function validarTipoDato($data){
      if($data['tipo_usuario'] == 1){
        if (!preg_match('/^[\p{L} ]+$/u', html_entity_decode($data['nombre']))){
          throw new Exception("El campo solo acepta letras, tildes y espacios");
          
        }
        if (!preg_match('/^[\p{L} ]+$/u', html_entity_decode($data['apellidos']))){
          throw new Exception("El campo solo acepta letras, tildes y espacios");
        }
        $validaFecha = Utils::valida_fecha($data['fecha_nacimiento']);
        if (empty($validaFecha)) {
          throw new Exception("La fecha " . $data['fecha_nacimiento'] . " no es v\u00E1lida");
        }
        $validaFechaNac = Utils::validarFechaNac($data['fecha_nacimiento']);
        if (empty($validaFechaNac)) {
          throw new Exception("Debe ser Mayor de edad");
        }
      }
      else{
        if (!preg_match('/^[a-zA-ZÁÉÍÓÚñáéíóúÑ0-9&"., ]{4,}$/u', html_entity_decode($data['nombre'])) && !preg_match('/(.*[a-zA-ZÁÉÍÓÚñáéíóúÑ]){3}/u', html_entity_decode($data['nombre']))){
          throw new Exception("El campo solo acepta letras, tildes y espacios");          
        }
      }

      if($data['tipo_doc'] == 1 || $data['tipo_doc'] == 2){
        if(!Utils::validar_EC($data['documento'])){
          throw new Exception("RUC o dni inválido");
        }
      }
      else{
        if(!preg_match('/^[a-zA-Z0-9]{6,}+$/u', $data['documento'])){
          throw new Exception("Ingrese un pasaporte v\u00E1lido");
        }
      }
      $dni_verify = Modelo_Usuario::existeDni($data['documento']);
      if(!empty($dni_verify)){
        throw new Exception("El documento de identidad ingresado ya existe");
      }

      if(!Utils::valida_telefono($data['telefono'])){
        throw new Exception("El tel\u00E9fono ingresado no es v\u00E1lido");
      }

      if(!Utils::es_correo_valido($data['correo'])){
        throw new Exception("El correo ingresado no es v\u00E1lido");
      }

      $correo_verify = Modelo_Usuario::existeCorreo($data['correo']);
      if(!empty($correo_verify)){
        throw new Exception("El correo ingresado ya existe");
      }
  }

  public function defaultScreen(){
    $tags["arrgenero"] = Modelo_Genero::consulta();
    Vista::render('inicio',$tags, '', '');
  }
}  
?>