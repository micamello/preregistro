$('body').css('background-color', '#204478');
var tipoUsuarioval;
$(document).ready(function(){
	if(leerCookie('preRegistro') != null){
		mostrarCampos(leerCookie('preRegistro'));
	}
	else{
		mostrarCampos(1);
	}
})
// inicializar campo fecha de nacimiento
if($('#fecha_nacimiento')){
	$('#fechanac').DateTimePicker({
      dateFormat: "yyyy-MM-dd",
      shortDayNames: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
      shortMonthNames: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
      fullMonthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre"],
      titleContentDate: "Configurar fecha",
      titleContentTime: "Configurar tiempo",
      titleContentDateTime: "Configurar Fecha & Tiempo",
      setButtonContent: "Listo",
      clearButtonContent: "Limpiar"
    });
}
$('.btntoogle').on('click', function(){
	var id ="";
	id = $(this)[0].id;
	var formRegister = $('#card_register');
	formRegister.removeClass('fadeInfadeOut').width('auto').addClass('fadeInfadeOut');
	resetFormulario();
	formShow(id);
});

function formShow(id){
	if(id == 'candForm'){
		mostrarCampos(1);
	}
	else{
		mostrarCampos(2);
	}
}

function mostrarCampos(idForm){
	// resetForm();
	var campos = [];
	var nombre;
	var apellidos;
	var tipo_documentacion;
	var documento;
	var fecha_nacimiento;
	var id_genero;
	var telefono;
	var correo;
	var sectorind;
	// var tipoUsuario;

	if($('#tipo_usuario').length){
		tipo_usuario = $('#tipo_usuario');
		tipo_usuarioval = idForm;
		tipo_usuario.val(idForm);
		tipoUsuarioval = idForm;
	}

	if($('#nombre')){
		nombre = $('#nombre');
		campos.push(nombre);
	}
	if($('#apellidos')){
		apellidos = $('#apellidos');
		campos.push(apellidos);
	}
	if($('#tipo_documentacion')){
		tipo_documentacion = $('#tipo_documentacion');
		campos.push(tipo_documentacion);
	}
	if($('#documento')){
		documento = $('#documento');
		campos.push(documento);
	}
	if($('#fecha_nacimiento')){
		fecha_nacimiento = $('#fecha_nacimiento');
		campos.push(fecha_nacimiento);
	}
	if($('#id_genero')){
		id_genero = $('#id_genero');
		campos.push(id_genero);
	}
	if($('#telefono')){
		telefono = $('#telefono');
		campos.push(telefono);
	}
	if($('#correo')){
		correo = $('#correo');
		campos.push(correo);
	}
	if($('#sectorind')){
		sectorind = $('#sectorind');
		campos.push(sectorind);
	}
	if(idForm == 1){
		buttonChange(1);
		// console.log($('#documento').siblings('label')[0]);
		$('#documento').siblings('label').html('Documento <span class="no">*</span>');
		$('#documento').attr('placeholder', 'Documento *');
		$('#telefono').attr('placeholder', 'Celular *');
		$('#correo').parent().removeClass('col-md-12').addClass('col-md-6');
		$('.register-heading').html('Registrarse como candidato');
		apellidos.parent().css('display', '');
		sectorind.parent().css('display', 'none');
		tipo_documentacion.parent().css('display', '');
		fecha_nacimiento.parent().css('display', '');
		id_genero.parent().css('display', '');
	}
	else{
		buttonChange(2);
		$('#documento').siblings('label').html('RUC <span class="no">*</span>');
		$('#documento').attr('placeholder', 'RUC *');
		$('#telefono').attr('placeholder', 'Teléfono *');
		$('#correo').parent().removeClass('col-md-6').addClass('col-md-12');
		$('#documento').removeAttr('disabled');
		$('#tipo_doc').val(1);
		$('.register-heading').html('Registrarse como empresa');
		apellidos.parent().css('display', 'none');
		sectorind.parent().css('display', '');
		tipo_documentacion.parent().css('display', 'none');
		fecha_nacimiento.parent().css('display', 'none');
		id_genero.parent().css('display', 'none');
	}

	safari();
}

// function resetForm(){

// }

function buttonChange(numero){
	var candForm = $('#candForm');
	var empForm = $('#empForm');
	if(numero == 1){
		if($('#tipo_documentacion').val() != null){
			$('#documento').removeAttr('disabled');
		}
		else{
			$('#documento').attr('disabled', 'true');
		}
		empForm.removeClass('active');
		empForm.removeClass('btn-outline-primary1');
		empForm.addClass('btn-outline-secondary');
		candForm.removeClass('btn-outline-secondary');
		candForm.addClass('btn-outline-primary1');
		candForm.addClass('active');
	}
	else{
		empForm.addClass('active');
		empForm.addClass('btn-outline-primary1');
		empForm.removeClass('btn-outline-secondary');
		candForm.addClass('btn-outline-secondary');
		candForm.removeClass('btn-outline-primary1');
		candForm.removeClass('active');
	}
}

if($('#nombre').length){
	$('#nombre').on('blur', function(){
		if($(this).val() != ""){
			if(tipoUsuarioval == 1){
				if(!validarNombreApellido($(this).val())){
					crearMensajeError($(this), "Ingrese un nombre válido");
				}
				else{
					eliminarMensajeError($(this));
				}
			}
			else
			if(tipoUsuarioval == 2){
				if(!validarNombreEmpresa($(this).val())){
					crearMensajeError($(this), "Ingrese un nombre válido");
				}
				else{
					eliminarMensajeError($(this));
				}
			}
		}
		else{
			crearMensajeError($(this), "Rellene este campo");
		}
	})
}

if($('#apellidos').length){
	$('#apellidos').on('blur', function(){
		if($(this).val() != ""){
			if(!validarNombreApellido($(this).val())){
				crearMensajeError($(this), "Ingrese un apellido válido");
			}
			else{
				eliminarMensajeError($(this));
			}
		}
		else{
			crearMensajeError($(this), "Rellene este campo");
		}
	})
}

if($('#tipo_documentacion').length){
	$('#tipo_documentacion').on('change blur', function(){
		var textoSelect = $(this).children('option:selected').text();
		var docCampo = $('#documento');
		
		if($(this).val() != null){
			docCampo.siblings('label').html('Número de '+textoSelect+ '<span class="no">*</span>');
			docCampo.attr('placeholder', "Número de "+textoSelect+" *");
			docCampo.removeAttr('disabled');
			$('#tipo_doc').val($(this).val());
				if(docCampo.val() != ""){ 
					if(DniRuc_Validador(docCampo,$(this).val()) == true){
						if(searchAjax(docCampo) != true){
							eliminarMensajeError(docCampo);
						}
						else{
							crearMensajeError(docCampo, "Documento ingresado ya existe");
						}
					}
					else{
						crearMensajeError(docCampo, "Documento ingresado no es válido");
					}
				}
				eliminarMensajeError($(this));
		}
		else{
			crearMensajeError($(this), "Seleccione una opción");
		}
	})
}

if($('#documento').length){
	$('#documento').on('keypress', function(event){
			if (event.keyCode == 0 || event.keyCode == 32){
				event.preventDefault();
			}
		});
	$('#documento').on('blur', function(){
		if($(this).val() != ""){
			$(this).val($(this).val().trim());
			var tipoDocCampo = $('#tipo_doc').val();
			if(DniRuc_Validador($(this), tipoDocCampo) == true){
				if(searchAjax($(this)) != true){
					eliminarMensajeError($(this));
				}
				else{
					crearMensajeError($(this), "Documento ingresado ya existe");
				}
			}
			else{
				crearMensajeError($(this), "Documento ingresado no es válido");
			}
		}
		else{
			crearMensajeError($(this), "Rellene este campo");
		}
	})
}


if($('#fecha_nacimiento').length){
	$('#fecha_nacimiento').on('blur change', function(){
		if($(this).val() != ""){
			if(validarFormatoFecha($(this).val())){
				if(!calcularEdad($(this).val())){
					crearMensajeError($(this), "Debe ser mayor de edad");
				}
				else{
					eliminarMensajeError($(this));
				}
			}
			else{
				crearMensajeError($(this), "Ingrese una fecha válida");
			}
		}
		else{
			crearMensajeError($(this), "Rellene este campo");
		}
	})
}

if($('#id_genero').length){
	$('#id_genero').on('blur change', function(){
		if($(this).val() != null){
			eliminarMensajeError($(this));
		}
		else{
			crearMensajeError($(this), "Seleccione una opción");
		}
	})
}


if($('#telefono').length){
	$('#telefono').on('keypress', function(event){
			if (event.keyCode == 0 || event.keyCode == 32){
				event.preventDefault();
			}
		});
	$('#telefono').on('blur change', function(){
		if($(this).val() != ""){
			$(this).val($(this).val().trim());
			if(tipoUsuarioval == 1){
				if(!validarCelCand($(this).val())){
					crearMensajeError($(this), "Mínimo 10 dígitos, máx. 15");
				}
				else{
					eliminarMensajeError($(this));
				}
			}
			else{
				if(!ValidarCelTelEmp($(this).val())){
					crearMensajeError($(this), "Mínimo 9 dígitos, máx. 15");
				}
				else{
					eliminarMensajeError($(this));
				}
			}
		}
		else{
			crearMensajeError($(this), "Rellene este campo");
		}
	})
}

if($('#correo').length){
	$('#correo').on('keypress', function(event){
		if (event.keyCode == 0 || event.keyCode == 32){
			event.preventDefault();
		}
	});
	$('#correo').on('blur', function(){
		if($(this).val() != ""){
			$(this).val($(this).val().trim());
			if(validarCorreo($(this).val())){
				if(searchAjax($(this)) != true){
					eliminarMensajeError($(this));
				}
				else{
					crearMensajeError($(this), "El correo ingresado ya existe");
				}
			}
			else{
				crearMensajeError($(this), "Ingrese un correo válido");
			}
		}
		else{
			crearMensajeError($(this), "Rellene este campo");
		}
	})
}

if($('#sectorind').length){
	$('#sectorind').on('blur change', function(){
		if($(this).val() != null){
			eliminarMensajeError($(this));
		}
		else{
			crearMensajeError($(this), "Seleccione una opción");
		}
	})
}

if($('#terminosCond').length){
	$('#terminosCond').on('change', function(){
		if($(this).prop('checked') == true){
			eliminarMensajeError($(this));
		}
		else{
			crearMensajeError($(this), "Debe aceptar términos y condiciones");
		}
	})
}

// submit el formulario
$('#preregistroFormulario').on('submit', function(event){
	validarOnSubmit();
	validarErrores();
	if(!validarErrores()){
		event.preventDefault();
	}
})

function validarOnSubmit(){
if($('#nombre').length){
		if($('#nombre').val() != ""){
			if(tipoUsuarioval == 1){
				if(!validarNombreApellido($('#nombre').val())){
					crearMensajeError($('#nombre'), "Ingrese un nombre válido");
				}
				else{
					eliminarMensajeError($('#nombre'));
				}
			}
			else
			if(tipoUsuarioval == 2){
				if(!validarNombreEmpresa($('#nombre').val())){
					crearMensajeError($('#nombre'), "Ingrese un nombre válido");
				}
				else{
					eliminarMensajeError($('#nombre'));
				}
			}
		}
		else{
			crearMensajeError($('#nombre'), "Rellene este campo");
		}
}

if(tipoUsuarioval == 1){
	if($('#apellidos').length){
		if($('#apellidos').val() != ""){
			if(!validarNombreApellido($('#apellidos').val())){
				crearMensajeError($('#apellidos'), "Ingrese un apellido válido");
			}
			else{
				eliminarMensajeError($('#apellidos'));
			}
		}
		else{
			crearMensajeError($('#apellidos'), "Rellene este campo");
		}
	}

	if($('#tipo_documentacion').length){
		var textoSelect = $('#tipo_documentacion').children('option:selected').text();
		var docCampo = $('#documento');
		docCampo.attr('placeholder', textoSelect+" *")
		if($('#tipo_documentacion').val() != null){
			docCampo.removeAttr('disabled');
			$('#tipo_doc').val($('#tipo_documentacion').val());
				if(docCampo.val() != ""){ 
					if(DniRuc_Validador(docCampo,$('#tipo_doc').val()) == true){
						if(searchAjax(docCampo) != true){
							eliminarMensajeError(docCampo);
						}
						else{
							crearMensajeError(docCampo, "Documento ingresado ya existe");
						}
					}
					else{
						crearMensajeError(docCampo, "Documento ingresado no es válido");
					}
				}
				eliminarMensajeError($('#tipo_documentacion'));
		}
		else{
			crearMensajeError($('#tipo_documentacion'), "Seleccione una opción");
		}
	}

	if($('#fecha_nacimiento').length){
		if($('#fecha_nacimiento').val() != ""){
			if(validarFormatoFecha($('#fecha_nacimiento').val())){
				if(!calcularEdad($('#fecha_nacimiento').val())){
					crearMensajeError($('#fecha_nacimiento'), "Debe ser mayor de edad");
				}
				else{
					eliminarMensajeError($('#fecha_nacimiento'));
				}
			}
			else{
				crearMensajeError($('#fecha_nacimiento'), "Ingrese una fecha válida");
			}
		}
		else{
			crearMensajeError($('#fecha_nacimiento'), "Rellene este campo");
		}
	}

	if($('#id_genero').length){
		if($('#id_genero').val() != null){
			eliminarMensajeError($('#id_genero'));
		}
		else{
			crearMensajeError($('#id_genero'), "Seleccione una opción");
		}
	}

}

if($('#documento').length){
	if($('#documento').val() != ""){
		// var tipoDocCampo = $('#tipo_documentacion').val();
		if(DniRuc_Validador($('#documento'), $('#tipo_doc').val()) == true){
			if(searchAjax($('#documento')) != true){
				eliminarMensajeError($('#documento'));
			}
			else{
				crearMensajeError($('#documento'), "Documento ingresado ya existe");
			}
		}
		else{
			crearMensajeError($('#documento'), "Documento ingresado no es válido");
		}
	}
	else{
		crearMensajeError($('#documento'), "Rellene este campo");
	}
}


if($('#telefono').length){
	if($('#telefono').val() != ""){
		if(tipoUsuarioval == 1){
			if(!validarCelCand($('#telefono').val())){
				crearMensajeError($('#telefono'), "Mínimo 10 dígitos, máx. 15");
			}
			else{
				eliminarMensajeError($('#telefono'));
			}
		}
		else{
			if(!ValidarCelTelEmp($('#telefono').val())){
				crearMensajeError($('#telefono'), "Mínimo 6 dígitos, máx. 15");
			}
			else{
				eliminarMensajeError($('#telefono'));
			}
		}
	}
	else{
		crearMensajeError($('#telefono'), "Rellene este campo");
	}
}

if($('#correo').length){
	if($('#correo').val() != ""){
		if(validarCorreo($('#correo').val())){
			if(searchAjax($('#correo')) != true){
				eliminarMensajeError($('#correo'));
			}
			else{
				crearMensajeError($('#correo'), "El correo ingresado ya existe");
			}
		}
		else{
			crearMensajeError($('#correo'), "Ingrese un correo válido");
		}
	}
	else{
		crearMensajeError($('#correo'), "Rellene este campo");
	}
}

if(tipoUsuarioval == 2){
	if($('#sectorind').length){
		if($('#sectorind').val() != null){
			eliminarMensajeError($('#sectorind'));
		}
		else{
			crearMensajeError($('#sectorind'), "Seleccione una opción");
		}
	}
}

	if($('#terminosCond').length){
		if($('#terminosCond').prop('checked') == true){
			eliminarMensajeError($('#terminosCond'));
		}
		else{
			crearMensajeError($('#terminosCond'), "Debe aceptar términos y condiciones");
		}
	}
}

// ------------------------------------------------------------------------
// funciones

function validarErrores(){
	var erroresdelform = $('.errorClass1, .errorClass');
	if(erroresdelform.length != 0){
		return false;
	}
	else{
		return true;
	}
}

function resetFormulario(){
	var camposdelform = $('#preregistroFormulario').find('input, select');
	$.each(camposdelform, function(indice, elemento){
		if($(elemento).prop('tagName') == "INPUT" 
			&& $(elemento).prop('type') != "submit"
			&& $(elemento).prop('type') != "hidden"){
			$(elemento).val('');
		}
		if($(elemento).prop('tagName') == "SELECT"){
			$(elemento).children('option:first-child').prop('selected', true);
		}
	});

	var errorClass1 = $('.errorClass1');
	var errorClass = $('.errorClass');
	$.each(errorClass, function(indice, elemento){
		$(elemento).removeClass('errorClass');
		$(elemento).text("");
	});
	$.each(errorClass1, function(indice, elemento){
		$(elemento).removeClass('errorClass1');
		$(elemento).text("");
	});
}

function validarCorreo(correo) { 
  return /^\s*([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\s*$/.test(correo);
}


function ValidarCelTelEmp(valor){
	if(/^[0-9]{9,15}$/.test(valor)){return true;}else{return false;}
}

function validarCelCand(valor){
	if(/^[0-9]{10,15}$/.test(valor)){return true;}else{return false;}
}

function calcularEdad(contenido){
    // Si la fecha es correcta, calculamos la edad
    var values=contenido.split("-");
    var dia = values[2];
    var mes = values[1];
    var ano = values[0];
    // cogemos los valores actuales
    var fecha_hoy = new Date();
    var ahora_ano = fecha_hoy.getYear();
    var ahora_mes = fecha_hoy.getMonth()+1;
    var ahora_dia = fecha_hoy.getDate();
    // realizamos el calculo
    var edad = (ahora_ano + 1900) - ano;

    if ( ahora_mes < mes )
    {
        edad--;
    }
    if ((mes == ahora_mes) && (ahora_dia < dia))
    {
        edad--;
    }
    if (edad > 1900)
    {
        edad -= 1900;
    }

    if(edad >= 18){
        
        return true;

    }else{
        return false;
    }
}

function validarFormatoFecha(campo) {
  var RegExPattern = /^\d{1,2}-\d{1,2}-\d{4}$/;
  var values = campo.split("-");
  var dia = parseInt(values[2]);
  var mes = parseInt(values[1]);
  var ano = parseInt(values[0]);

  if((dia <= 0 || dia > 31) || (mes <= 0 || mes > 12) || (ano <= 1500 || ano > 2099)){
    return false;
  }else if ((RegExPattern.test(dia+"-"+mes+"-"+ano)) && (campo!='')) {
    return true;
  } else {
    return false;
  }
}

function searchAjax(obj){
	var val_retorno1 = "";	
	var puerto_host = $('#puerto_host').val();
	var contenido = $(obj).val();
	var url;
	var tipo_dni = $('#tipo_usuario').val();
		if(contenido != "" && tipo_dni != ""){
			if(obj[0].id == "documento"){
				url = puerto_host+"/index.php?mostrar=PreRegistro&opcion=buscarDni&dni="+contenido;
			}
			if(obj[0].id == "correo"){
				url = puerto_host+"/index.php?mostrar=PreRegistro&opcion=buscarCorreo&correo="+contenido;
			}
			$.ajax({
        type: "GET",
        url: url,
        dataType:'json',
        async: false,
        success:function(data){
            if(!$.trim(data)){
            	val_retorno1 = false;
            }
            else{
            	val_retorno1 = true;
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
        }
		  });
		}
	return val_retorno1;
}

function crearMensajeError(obj, mensaje){
	var divError = $(obj).prev();
	if($(obj).attr('id') == "terminosCond"){
		$(obj).parents(':eq(2)').prev().removeClass("errorClass1");
		$(obj).parents(':eq(2)').prev().text("");
		$(obj).parents(':eq(2)').prev().text(mensaje);
		$(obj).parents(':eq(2)').prev().addClass("errorClass1");
	}
	else{
		divError.removeClass("errorClass");
		divError.text("");
		divError.text(mensaje);
		divError.addClass("errorClass");
	}
}

function eliminarMensajeError(obj){
	var divError = $(obj).prev();
	if($(obj).attr('id') == "terminosCond"){
		$(obj).parents(':eq(2)').prev().removeClass("errorClass1");
		$(obj).parents(':eq(2)').prev().text("");
	}
	else{
		divError.removeClass("errorClass");
		divError.text("");
	}
}

function validarNombreApellido(nombre){
	if((/^[A-Za-zÁÉÍÓÚñáéíóúÑ ]{1,}$/.test(nombre)) && (/(.*[a-zA-ZÁÉÍÓÚñáéíóúÑ]){1,}/.test(nombre))){
		return true;
	}
	else{
		return false;
	}
}

function validarNombreEmpresa(nombre){
	if((/^([a-zA-ZÁÉÍÓÚñáéíóúÑ]+[0-9&.,' ]*)*$/.test(nombre))){
		return true;
	}
	else{
		return false;
	}
}

function leerCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function safari(){
	var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
	if(isSafari == true){
		var safariGrid = $('.form-group');
		$.each(safariGrid, function(indice, elemento){
			$(elemento).removeClass('col-md-6');
			$(elemento).removeClass('col-xs-12');
			$(elemento).addClass('col-md-12');
		});
	}
}