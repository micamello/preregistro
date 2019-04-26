<!DOCTYPE html>
<html>
<head>
	<title>MiCamello - Portal de Empleos en Ecuador</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="keywords" content="ofertas de trabajo, trabajos, empleos, bolsa de empleos, buscar trabajo, busco empleo, portal de empleo, ofertas de empleo, bolsa de empleo, trabajos en ecuador, paginas de empleo, empleos ecuador, camello">
	<meta name="description" content="Cientos de empresas publican las mejores ofertas en la bolsa de trabajo Mi Camello Ecuador. Busca empleo y apúntate y sé el primero en postular">
	  <!--<link rel="alternate" hreflang="ec-EC" href="https://www.micamello.com.ec/" />-->
	<meta property="og:image" content="<?php echo PUERTO."://".HOST;?>/imagenes/imagen.jpg" />
	<meta property="og:description" content="" />
  	<link rel="shortcut icon" href="<?php echo PUERTO."://".HOST;?>/imagenes/favicon/favicon.ico" />
	<!-- web-fonts -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href="<?php echo PUERTO."://".HOST;?>/css/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Style CSS -->
	<link href="<?php echo PUERTO."://".HOST;?>/css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo PUERTO."://".HOST;?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PUERTO."://".HOST;?>/css/DateTimePicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo PUERTO."://".HOST;?>/css/micamello.css">	
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123345917-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-123345917-1');
	</script>
</head>
<body style="background-image: url('<?php echo PUERTO."://".HOST;?>/imagenes/fondo.jpg');">

<?php 
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	function getBrowser($user_agent){
	  if(strpos($user_agent, 'MSIE') !== FALSE)
	    return 'MSIE';
	  elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
	    return 'Microsoft Edge';
	  elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
	    return 'Internet explorer 11';
	  elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
	    return "Opera Mini";
	  elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
	    return "Opera";
	  elseif(strpos($user_agent, 'Firefox') !== FALSE)
	    return 'Mozilla Firefox';
	  elseif(strpos($user_agent, 'Chrome') !== FALSE)
	    return 'Google Chrome';
	  elseif(strpos($user_agent, 'Safari') !== FALSE)
	    return "Safari";
	  else
	    return 'No hemos podido detectar su navegador';
	}
	$navegador = getBrowser($user_agent);	
 ?>
<?php if($navegador == 'MSIE'){ ?>
  <div align="center" id="mensaje" style="height: 150px;background: #c36262;"><br>
    <h3>Usted esta usando internet explorer 8 o inferior</h3>
    <p>Esta es una versi&oacute;n antigua del navegador, y puede afectar negativamente a su seguridad y su experiencia de navegaci&oacute;n.</p><p>Por favor, actualice a la version actual de IE o cambie de navegador ahora.</p>
    <p><b><a href="https://www.microsoft.com/es-es/download/internet-explorer.aspx">Actualizar IE</a></b></p>
  </div>
  <?php } ?>

<section class="wraper">
  		<header class="header">
			<div class="row">
			  <div class="col-md-2" >
			   	<img style="width: 100%" src="<?php echo PUERTO."://".HOST;?>/imagenes/logo.png" class=""><br>
			  </div>  
			</div>        
  			<h1 align="center" class="faltan">FALTAN</h1>
  		</header>
  		<!-- .header -->
  		<section class="countdown-wrapper" align="center">
  		    <div class="container">
  		        <div align="center">
  		            <ul id="back-countdiown">
		  				<li>                    
		  					<span class="days">00</span>
		  					<p class="counter"><b>DÍAS</b></p>
		  				</li>
		  				<li>
		  					<span class="hours">00</span>
		  					<p class="counter"><b>HORAS</b></p>
		  				</li>
		  				<li>
		  					<span class="minutes">00</span>
		  					<p class="counter"><b>MINUTOS</b></p>
		  				</li>
				       	<li>
				        	 <span class="seconds">00</span>
				        	 <p class="counter"><b>SEGUNDOS</b></p>
				       	</li>
		  			</ul><!-- #back-countdiown -->
  		        </div>
  		    </div>  			        
  		</section><!-- .countdown-wrapper -->
  	</section>

  	<?php 
		date_default_timezone_set('America/Guayaquil');
  	?>
<div class="row">
  <div class="col-md-12 registrate" align="center">
    REGÍSTRATE
  </div>
</div>
<div class="row" align="center">
  <div class="col-md-12" >
    <!-- <a href="#" data-toggle="modal" onclick="set_tipo_user(1)" data-target="#myModal"> -->
    <a href="#" onclick="modalRise(1);">
		<img style="width: 200px"  src="<?php echo PUERTO."://".HOST;?>/imagenes/candidato.png">
	</a>
  </div>
  <div class="col-md-12" >
    <!-- <a href="#" data-toggle="modal" onclick="set_tipo_user(2)" data-target="#myModal"> -->
   	<a href="#" onclick="modalRise(2);">
		<img style="width: 200px" src="<?php echo PUERTO."://".HOST;?>/imagenes/empresa.png">
	</a>
  </div> 
</div>

<div id="pre_registro_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <form action="<?php echo PUERTO."://".HOST;?>/preregistro/" method="post" id="form_pre">
      	<input type="hidden" name="form_pre" value="1">
      	<input type="text" hidden id="puerto_host" value="<?php echo PUERTO."://".HOST ;?>">
     	<input type="hidden" name="tipo_usuario" id="tipo_usuario">
     	<input type="hidden" name="tipo_doc" id="tipo_doc">
      <div class="modal-body">
			<div class="">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nombre">Nombre tipo</label>
								<input type="text" id="nombre" name="nombre" class="form-control">
								<div></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="apellidos">Apellidos</label>
								<input type="text" id="apellidos" name="apellidos" class="form-control">
								<div></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="nombre">Tipo de documentación</label>
								<select class="form-control" id="tipo_documentacion" name="tipo_documentacion">
									<option value="" selected="selected" disabled="disabled">Seleccione una opción</option>
									<?php foreach (TIPO_DOCUMENTO as $key => $value): ?>
										<?php
											if($value != "Ruc"){
											?>
												<option value="<?php echo $key; ?>"><?php echo utf8_encode($value); ?></option>
											<?php
											}
										 ?>
									<?php endforeach ?>
								</select>
								<div></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="documento" class="document-title">Documento</label>
								<input type="text" id="documento" name="documento" class="form-control">
								<div></div>
							</div>
						</div>

            <div class="col-md-6">
							<div class="form-group">
								<label for="fechanacimiento">Fecha de Nacimiento</label>
								<input type="text" id="fecha_nacimiento" class="form-control" data-field="date" max="<?php echo date('Y-m-d'); ?>" placeholder="aaaa-mm-dd" name="fecha_nacimiento">
								<div id="fechanac"></div>
								<div id="fecha_err"></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="nombre">Genero</label>
								<select class="form-control" id="id_genero" name="id_genero">
									<option value="" selected="selected" disabled="disabled">Seleccione una opción</option>
									<?php foreach ($arrgenero as $key=>$value){ ?>										
										<option value="<?php echo $value["id_genero"]; ?>"><?php echo utf8_encode($value["descripcion"]); ?></option>
									<?php } ?>
								</select>
								<div></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="telefono">Teléfono</label>
								<input type="text" id="telefono" name="telefono" class="form-control">
								<div></div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="correo">Correo</label>
								<input type="text" id="correo" name="correo" class="form-control">
								<div></div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Sector industrial</label>
								<select id="sectorind" name="sectorind" class="form-control">
									<option value="" selected="selected" disabled="disabled">Seleccione una opción</option>
									<?php 
									if(!empty($arrsectorind)){
										foreach ($arrsectorind as $sector) {
											echo "<option value='".$sector['id_sectorindustrial']."'>".$sector['descripcion']."</option>";
										}
									}
									else{
										echo "<option value='' selected='selected' disabled='disabled'>Seleccione una opción</option>";
									}
									?>
								</select>
								<div></div>
							</div>
						</div>

						<div class="col-md-12 text-center">
							<div class="form-group">
								<label for="termcond"></label><br><input type="checkbox" name="term_cond" id="term_cond"> He le&iacute;do y acepto las <a href="<?php echo PUERTO."://".HOST."/docs/politicas_de_privacidad1.pdf";?>" target="_blank">pol&iacute;ticas de privacidad</a> y <a href="<?php echo PUERTO."://".HOST."/docs/terminos_y_condiciones1.pdf";?>" target="_blank">t&eacute;rminos y condiciones</a>								
							</div>
              <div class="form-group"><div id="termcond_err"></div></div>
						</div>

					</div>
				</div>
			</div>
      </div>
      <div class="modal-footer" style="text-align:center;">
       <input type="submit" name="guardar" value="Guardar" class="btn btn-success">
      </div>
    </div>
    </form>
  </div>
</div>

<script src="<?php echo PUERTO."://".HOST;?>/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/bootstrap.min.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/coundown-timer.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/scripts.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/sweetalert.min.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/DateTimePicker.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/DniRuc_Validador.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/micamello.js"></script>

<?php if (isset($sess_err_msg) && !empty($sess_err_msg)){
  echo "<script type='text/javascript'>
        $(document).ready(function(){
          swal('Advertencia!', '".$sess_err_msg."', 'error');
        });
      </script>";
}?>

<?php if (isset($sess_suc_msg) && !empty($sess_suc_msg)){
  echo "<script type='text/javascript'>
        $(document).ready(function(){
          swal('Exitoso!', '".$sess_suc_msg."', 'success');
        });
      </script>";
} ?>

</body>
</html>