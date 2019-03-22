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
	<link rel="stylesheet" type="text/css" href="<?php echo PUERTO."://".HOST;?>/css/micamello.css">
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
<!-- <script src="<?php echo PUERTO."://".HOST;?>/js/mic.js"></script> -->
<script src="<?php echo PUERTO."://".HOST;?>/js/sweetalert.min.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/micamello.js"></script>
<script src="<?php echo PUERTO."://".HOST;?>/js/DniRuc_Validador.js"></script>

<?php 

	if(isset($_SESSION['mensaje'])){
		if($_SESSION['mensaje'] == 1){
			?>
				<script type="text/javascript">
					registro_success();
				</script>
			<?php
			$_SESSION['mensaje'] = "";
		}
	}

 ?>

<?php if (isset($sess_err_msg) && !empty($sess_err_msg)){
      /*<div align="center" id="alerta" style="display:" class="alert alert-danger" role="alert">
        <strong><?php #echo $sess_err_msg;?></strong>
      </div>  */
      echo "<script type='text/javascript'>
            $(document).ready(function(){
              swal('Advertencia!', '".$sess_err_msg."', 'error');
            });
          </script>";
    }?>
<!-- <script type="text/javascript">
	$("#documento").DniRuc_Validador();
</script> -->


<!-- <script type="text/javascript" src="<?php echo PUERTO."://".HOST;?>/js/ruc_jquery_validator.min.js"></script> -->
</body>
</html>