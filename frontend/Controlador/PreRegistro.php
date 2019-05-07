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
      case 'registro':
        self::formulario();
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
    $url = "";
    $tipo_usuario = Utils::getParam('tipo_usuario'); 
    $campos = array();   
    try {
      if ( Utils::getParam('form_pre') == 1 ){
        if($tipo_usuario == 1){
          $campos = array('nombre'=>1, 'apellidos'=>1, 'tipo_doc'=>1, 'documento'=>1, 'telefono'=>1, 
                          'correo'=>1, 'tipo_usuario'=>1, 'fecha_nacimiento'=>1, 'id_genero'=>1); 
        }else{
          $campos = array('nombre'=>1, 'tipo_doc'=>1, 'documento'=>1, 'telefono'=>1, 'correo'=>1, 'tipo_usuario'=>1, 'sectorind'=>1); 
        }
        $data = $this->camposRequeridos($campos);
        self::validarTipoDato($data);
        self::guadarRegistro($data);
        setcookie('preRegistro', null, -1, '/');
        $nombres = $data['nombre'].((isset($data['apellidos'])) ? " ".$data['apellidos'] : '');
        if (!$this->correoPreregistro($data['correo'],$nombres)){
            throw new Exception("Error en el env\u00EDo de correo, por favor intente denuevo");
        }

        $url = "";
        $_SESSION['mostrar_exito'] = "Se ha registrado correctamente";
      }
    } catch (Exception $e) {
      setcookie('preRegistro', $tipo_usuario, time() + (86400 * 30), "/");
      $url = "registrodatos/";
      $_SESSION['mostrar_error'] = $e->getMessage();
    }
    Utils::doRedirect(PUERTO.'://'.HOST.'/'.$url);
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
                              'id_sectorindustrial'=>$data['sectorind'],
                              'term_cond'=>1);
    }
    if(!Modelo_Usuario::guardarUsuario($datos_usuario)){
      throw new Exception("Ha ocurrido un error, intente nuevamente en un momento");
    }
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

  public function correoPreregistro($correo,$nombres){
    $email_body = Modelo_TemplateEmail::obtieneHTML("PREREGISTRO_USUARIO");  
    $email_body = str_replace("%NOMBRES%", $nombres, $email_body); 
    if (Utils::envioCorreo($correo,"Preregistro Usuario",$email_body)){
      return true;
    }
    else{
      return false;
    }
  }

  public function defaultScreen(){
    setcookie('preRegistro', null, -1, '/');
    $tags["template_css"][] = "estilo";
    $tags["template_css"][] = "font-awesome.min";
    $tags["template_css"][] = "bootstrap";
    $tags["template_css"][] = "mic";
    $tags["template_css"][] = "multiple_select";
    $tags["template_js"][] = "bootstrap.min";
    $tags["template_js"][] = "coundown-timer";
    $tags["template_js"][] = "scripts";
    Vista::render('inicio',$tags);
  }

  public function formulario(){
    $arrgenero = Modelo_Genero::consulta();
    $arrsectorind = Modelo_SectorIndustrial::consulta();
    $tags = array("arrgenero"=>$arrgenero,
                  "arrsectorind"=>$arrsectorind);

    $tags["template_css"][] = "css-pre/estilo";
    $tags["template_css"][] = "css-pre/style";
    // $tags["template_css"][] = "css-pre/mic";
    $tags["template_css"][] = "css-pre/bootstrap";
    $tags["template_css"][] = "DateTimePicker";
    $tags["template_js"][] = "DateTimePicker";
    $tags["template_js"][] = "DniRuc_Validador";
    $tags["template_js"][] = "js-pre/preregistro";
    Vista::render('formulario',$tags);
  }
}  
?>