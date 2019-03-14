var modal = $('#pre_registro_modal');
var modal_title;
var tipo_doc_label;
var nombre_label;

var nombre_form;
var apellidos_form;
var tipo_documentacion_form = "";
var documento_form;
var telefono_form;
var correo_form;
var campos = [];
var tipo_usuario;
var tipo_doc = $('#tipo_doc');

function camposandvar(){
	campos = [];
	if($('#nombre').length){
		nombre_form = $('#nombre');
		campos.push(nombre_form);

	}
	if($('#apellidos').length){
		apellidos_form = $('#apellidos');
		campos.push(apellidos_form);

	}
	if($('#tipo_documentacion').length){
		tipo_documentacion_form = $('#tipo_documentacion');
		campos.push(tipo_documentacion_form);

	}
	if($('#documento').length){
		documento_form = $('#documento');
		campos.push(documento_form);

	}
	if($('#telefono').length){
		telefono_form = $('#telefono');
		campos.push(telefono_form);

	}
	// if($('#correo').length){
	// 	correo_form = $('#correo');
	// 	campos.push(correo_form);

	// }	
	return campos;
}



function modalRise(id_tipo){
	$('#tipo_usuario').val(id_tipo);
	tipo_usuario = id_tipo;
	camposandvar();
	documento_form.attr('disabled', 'true');
	if(id_tipo == 1){
		modal_title = "Registro datos candidato";
		nombre_label = "Nombres";
		document_label = "Documento";
		apellidos_form.parents('.col-md-6').css('display', '');
		tipo_documentacion_form.parents('.col-md-6').css('display', '');
	}
	else{
		modal_title = "Registro datos empresa";
		nombre_label = "Nombre Empresa";
		document_label = "Ruc";
		tipo_doc.val(1);
		apellidos_form.parents('.col-md-6').css('display', 'none');
		tipo_documentacion_form.parents('.col-md-6').css('display', 'none');
		documento_form.removeAttr('disabled');

	}
	nombre_form.prev().text(nombre_label);
	modal.find('.modal-title').text(modal_title);
	modal.find('.document-title').text(document_label);
	modal.modal('show');
}

camposandvar();
if(tipo_documentacion_form != ""){
	tipo_documentacion_form.on('change', function(){
		var seleccionado = $(this).children("option:selected").text();
		$(documento_form).prev().text(seleccionado);
		documento_form.removeAttr('disabled');
		tipo_doc.val($(this).children("option:selected").val());
	})
}

$('#form_pre').on('submit', function(event){
	verifyempty(camposandvar());
	permitidos();
	if($('#documento').val() != ""){
		if(DniRuc_Validador($('#documento')) != true){
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
	if($('#correo').val() != ""){
		if(validarCorreo($('#correo').val())){
			if(searchAjax($('#correo')) == false){
				eliminarMensajeError($('#correo'));
			}else{
				crearMensajeError($('#correo'), "El correo ingresado ya existe");
			}
		}
		else{
			crearMensajeError($('#correo'), "El correo ingresado no es válido");
		}
	}
	else{
		crearMensajeError($('#correo'), "Rellene este campo");
	}
	if(counterror() > 0){
		event.preventDefault();
	}
});

function verifyempty(){
	var array = camposandvar();
	var mensaje = "";
	for (var i = 0; i < array.length; i++) {
		if($(array[i]).parents('.col-md-6').css('display') != 'none'){
			if($(array[i]).val() == "" || $(array[i]).val() == null){
				if($(array[i]).prop('tagName') == "SELECT"){
					mensaje = "Seleccione una opción";
				}
				else{
					mensaje = "Rellene este campo";
				}
				crearMensajeError($(array[i]), mensaje);
			}
			else{
				eliminarMensajeError($(array[i]));
			}
		}
	}
}

function crearMensajeError(obj, mensaje){
	if($(obj).length){
		$(obj).addClass('error_input');
		$(obj).next().attr('class', 'error_class ahashakeheartache');
		$(obj).next().text(mensaje);
	}
}

function eliminarMensajeError(obj, mensaje){
	if($(obj).length){
		$(obj).removeClass('error_input');
		$(obj).next().removeAttr('class');
		$(obj).next().text("");
	}
}

function counterror(){
	var errors = $('.error_class');
	return errors.length;
}

$('#pre_registro_modal').on('hidden.bs.modal', function(){
	var campos_form = camposandvar();
	for (var i = 0; i < campos.length; i++) {
	 $(campos[i]).val("");
	}
	if($('.error_class').length){
		var errores_form = $('.error_class');
		for (var i = 0; i < errores_form.length; i++) {
			$(errores_form[i]).removeClass('error_class');
			$(errores_form[i]).removeClass('ahashakeheartache');
			$(errores_form[i]).text("");
		}
	}
	if($('.error_input').length){
		var errores_form1 = $('.error_input');
		for (var i = 0; i < errores_form1.length; i++) {
			$(errores_form1[i]).removeClass('error_input');
			// $(errores_form1[i]).text("");
		}
	}

});

function validarCaracteresPermitidos(tipo, contenido){	
	var tipo_validacion = [];
	var tipo_d = $('#tipo_doc').val();
	tipo_validacion.push(["nombre_apellido", ['El dato ingresado no es válido', validarNombreApellido(contenido[0].value)]]);
	tipo_validacion.push(["correo", ['El ' +contenido.siblings('label').text()+ ' ingresado no es válido', validarCorreo(contenido[0].value)]]);
	tipo_validacion.push(["telefono", ['El ' +contenido.siblings('label').text()+ ' ingresado no es válido', validarTelefono(contenido[0].value)]]);
	tipo_validacion.push(["nombre_empresa", ['El dato ingresado no es válido', validarNombreEmpresa(contenido[0].value)]]);
	// console.log(tipo_validacion);
	if (tipo == tipo_validacion[0][0] && (contenido[0].value != null && contenido[0].value != "")) {
		if(!(tipo_validacion[0][1][1])){
			crearMensajeError(contenido, tipo_validacion[0][1][0]);
		}
		else{
			eliminarMensajeError(contenido);
		}
	}
	if (tipo == tipo_validacion[1][0] && (contenido[0].value != null && contenido[0].value != "")) {
		if(!(tipo_validacion[1][1][1])){
			crearMensajeError(contenido, tipo_validacion[1][1][0]);
		}
		else{
			eliminarMensajeError(contenido);
		}
	}
	if (tipo == tipo_validacion[2][0] && (contenido[0].value != null && contenido[0].value != "")) {
		if(!(tipo_validacion[2][1][1])){
			crearMensajeError(contenido, tipo_validacion[2][1][0]);
		}
		else{
			eliminarMensajeError(contenido);
		}
	}
	if (tipo == tipo_validacion[3][0] && (contenido[0].value != null && contenido[0].value != "")) {
		if(!(tipo_validacion[3][1][1])){
			crearMensajeError(contenido, tipo_validacion[3][1][0]);
		}
		else{
			eliminarMensajeError(contenido);
		}
	}
};

function permitidos(){
	var campos_and_var = camposandvar();
	if(tipo_usuario == 1)
	{
		validarCaracteresPermitidos('nombre_apellido', campos_and_var[0]);
		validarCaracteresPermitidos('nombre_apellido', campos_and_var[1]);
	}
	else{
		validarCaracteresPermitidos('nombre_empresa', campos_and_var[0]);
	}
	validarCaracteresPermitidos('telefono', campos_and_var[4]);
	// validarCaracteresPermitidos('correo', campos_and_var[5]);
}

$('#nombre').on('blur', function(){
	var contenido = $(this).val();
	if(contenido != ""){
		if(tipo_usuario == 1){
			validarCaracteresPermitidos('nombre_apellido', $(this));
		}
		else{
			validarCaracteresPermitidos('nombre_empresa', $(this));
		}
	}
	else{
		crearMensajeError(this, "Rellene este campo");
	}
});

$('#apellidos').on('blur', function(){
	if(tipo_usuario == 1){
		var contenido = $(this).val();
		if(contenido != ""){
			validarCaracteresPermitidos('nombre_apellido', $(this));
		}
		else{
			crearMensajeError(this, "Rellene este campo");
		}
	}
});


$('#tipo_documentacion').on('change', function(){
	if(tipo_usuario == 1){
		eliminarMensajeError($(this));
	}
});

$('#telefono').on('blur', function(){
	var contenido = $(this).val();
	if(contenido != ""){
		validarCaracteresPermitidos('telefono', $(this));
	}
	else{
		crearMensajeError(this, "Rellene este campo");
	}
});

$('#correo').on('blur', function(){
	var contenido = $(this).val();
	if(contenido != ""){
		// validarCaracteresPermitidos('correo', $(this));
		if(validarCorreo($(this).val())){
			if(searchAjax($(this)) == false){
				eliminarMensajeError($(this));
			}else{
				crearMensajeError($(this), "El correo ingresado ya existe");
			}
		}
		else{
			crearMensajeError($(this), "El correo ingresado no es válido");
		}
	}
	else{
		crearMensajeError(this, "Rellene este campo");
	}
});

function validarCorreo(correo) { 
  return /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(correo);
}

function validarNombreApellido(nombre){
	// return /^[A-Za-zÁÉÍÓÚñáéíóúÑ ]+?$/.test(nombre);
	if((/^[A-Za-zÁÉÍÓÚñáéíóúÑ ]{4,}$/.test(nombre)) && (/(.*[a-zA-ZÁÉÍÓÚñáéíóúÑ]){1}/.test(nombre))){
		return true;
	}
	else{
		return false;
	}
}

function validarNombreEmpresa(nombre){
	if((/^[a-zA-ZÁÉÍÓÚñáéíóúÑ0-9&.,' ]{4,}$/.test(nombre)) && (/(.*[a-zA-ZÁÉÍÓÚñáéíóúÑ]){3}/.test(nombre))){
		return true;
	}
	else{
		return false;
	}
	// return /^[A-Za-zÁÉÍÓÚñáéíóúÑ@0-9&.,' ]+?$/.test(nombre);
}

function validarTelefono(telefono){
	return /^[0-9]{10,15}$/.test(telefono);
}

function validarNumero(numero){
	return /^[1-5]{1,1}$/.test(numero);
}

function searchAjax(obj){
	var val_retorno1 = "";	
	var puerto_host = $('#puerto_host').val();
	var contenido = $(obj).val();
	var url;
	var tipo_dni = $('#tipo_usuario').val();
		if(contenido != "" && tipo_dni != ""){
			if(obj[0].id == "documento"){
				url = puerto_host+"?mostrar=PreRegistro&opcion=buscarDni&dni="+contenido;
			}
			if(obj[0].id == "correo"){
				url = puerto_host+"?mostrar=PreRegistro&opcion=buscarCorreo&correo="+contenido;
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

$('#documento').on('blur', function(){
	if($(this).val() != ""){
		if(DniRuc_Validador($(this)) != true){
			if(searchAjax($(this)) != true){
				eliminarMensajeError($(this));
			}else{
				crearMensajeError($(this), "Documento ingresado ya existe");
			}
		}else{
			crearMensajeError($(this), "Documento ingresado no es válido");
		}
	}
	else{
		crearMensajeError($(this), "Rellene este campo");
	}
})

function registro_success(){	
	swal("CORRECTO!", "Te has registrado correctamente!", "success");
}

function registro_fail(){
	swal("ERROR!", "Ha ocurrido un error. Intente nuevamentE!", "error");
}