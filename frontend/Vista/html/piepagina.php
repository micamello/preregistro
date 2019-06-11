<input type="text" hidden id="puerto_host" value="<?php echo PUERTO."://".HOST ;?>">
<input type="hidden" id="iso" value="<?php echo SUCURSAL_ISO; ?>">
<script src="<?php echo PUERTO."://".HOST;?>/js/jquery-2.1.4.min.js"></script>
<!-- <script src="<?php echo PUERTO."://".HOST;?>/js/sweetalert.min.js"></script> -->
<script src="<?php echo PUERTO."://".HOST;?>/js/sweetalert.v2.js"></script>
<?php
if (isset($template_js) && is_array($template_js)){
  foreach($template_js as $file_js){
    echo '<script type="text/javascript" src="'.PUERTO.'://'.HOST.'/js/'.$file_js.'.js"></script>';
  }  
}
?>
<?php if (isset($sess_err_msg) && !empty($sess_err_msg)){
  echo "<script type='text/javascript'>
        $(document).ready(function(){
          Swal.fire({            
            text: '".$sess_err_msg."',
            imageUrl: '".PUERTO."://".HOST."/imagenes/wrong-04.png',
            imageWidth: 75,
            confirmButtonText: 'ACEPTAR',
            animation: true
          });
        });
      </script>";
}?>

<?php if (isset($sess_suc_msg) && !empty($sess_suc_msg)){
  echo "<script type='text/javascript'>
        $(document).ready(function(){
          Swal.fire({            
            text: '".$sess_suc_msg."',
            imageUrl: '".PUERTO."://".HOST."/imagenes/logo-04.png',
            imageWidth: 210,
            confirmButtonText: 'ACEPTAR',
            animation: true
          });
        });
      </script>";
} ?>
	</body>
</html>