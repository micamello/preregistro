<?php
define('HOST', 'localhost/preregistro');
define('SUCURSAL_ID','1');
define('SUCURSAL_ICONO','png');
define('SUCURSAL_LOGO','png');
define('SUCURSAL_PAISID','14');
define('SUCURSAL_MONEDA','1');
define('SUCURSAL_ISO','EC');
define('PUERTO', 'http');
define('FRONTEND_RUTA', 'C:/wamp64/www/preregistro/');
define('DBSERVIDOR', 'localhost');
define('DBUSUARIO', 'root'); 
define('DBNOMBRE', 'micamello_desarrollo2');
define('DBCLAVE', '');     
define('RUTA_INCLUDES', FRONTEND_RUTA.'includes/');
define('RUTA_FRONTEND', FRONTEND_RUTA.'frontend/'); 
define('RUTA_VISTA', FRONTEND_RUTA.'frontend/Vista/');
define('TOKEN', 'token.micamello.ecuador');
define('HORAS_VALIDO_PASSWORD', '24');
define('MAIL_CORREO','info@micamello.com.ec');
define('MAIL_NOMBRE','Mi Camello');
define('MAIL_USERNAME','info@micamello.com.ec');
define('MAIL_PASSWORD','bXKX695=ukC@');
define('MAIL_PORT','587');
define('MAIL_HOST','mail.micamello.com.ec');
define('KEY_ENCRIPTAR','micamelloecuador');
define('ESTADOS',array('1'=>'Activo','0'=>'Inactivo'));
define('MAIL_SUGERENCIAS','info@micamello.com.ec');

define('GENERO', array('M'=>'Masculino', 'F'=>'Femenino', 'P'=>'Prefiero no decirlo'));
define('VALOR_GENERO', array('M'=>'1', 'F'=>'2', 'P'=>'3'));

define('ESTADO_CIVIL',array('1'=>'Soltero(a)', '2'=>'Uni�n libre', '3'=>'Casado(a)', '4'=>'Separado(a)','5'=>'Divorciado(a)','6'=>'Viudo(a)','7'=>'Otro'));
define('CRON_RUTA',FRONTEND_RUTA.'cron/');
define('DIAS_AUTOPOSTULACION','3');
define('AUTOPOSTULACION_MIN','5');
define('TIPO_DOCUMENTO', array('1'=>'Ruc','2'=>'C�dula','3'=>'Pasaporte'));

?>