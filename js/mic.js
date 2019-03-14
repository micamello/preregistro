/*if($('#documentacion')){
    var documentacion = document.getElementById("documentacion");
}*/

if($('#error_cedula')){
    var error_cedula = document.getElementById("error_cedula");
}


$("#documentacion").on("change", function(){
    error_cedula.style.display = "none";
	var dni = document.getElementById("dni");
	dni.value = "";
	if(this.value != null || this.value != ""){
		dni.removeAttribute("disabled");
		if (this.value == 3) {
			dni.removeAttribute("onblur");
		    dni.removeAttribute("minlength");
		    dni.removeAttribute("maxlength");
		    dni.removeAttribute("title");
		}
		else{
		    dni.setAttribute("title", "Mínimo 10 dígitos");
		    dni.setAttribute("minlength", "10");
		    dni.setAttribute("maxlength", "10");
			dni.setAttribute("onblur", "validarDocumento(this);");
		}
		dni.removeAttribute("pattern");
	}
})

function set_tipo_user(value)
    {
        $("#tipo_usuario").val(value);
        if(value == 2)
        {
            document.getElementById("dni").setAttribute("onblur", "validarDocumento(this);");
            document.getElementById("dni").disabled = false;
            document.getElementById("label_ruc_dni").innerHTML = "RUC";
            document.getElementById("dni").setAttribute("minlength", "13");
            document.getElementById("dni").setAttribute("maxlength", "13");
            document.getElementById("dni").setAttribute("pattern", "[0-9]{13,13}");
            document.getElementById("dni").setAttribute("title", "Mínimo 13 dígitos");
            document.getElementById("label_name").innerHTML = "Nombre empresa";
            document.getElementById("component_apellido").style.display = "none";
            document.getElementById("apellido_input").required = false;
            document.getElementById("documentacion").required = false;
            document.getElementById("doc_select").style.display = "none";
            document.getElementById("nombre").setAttribute("pattern", "[A-Z a-z 0-9]+");
        }
        else
        {
            document.getElementById("dni").disabled = true;
            document.getElementById("label_ruc_dni").innerHTML = "Cédula/Pasaporte";
            document.getElementById("label_name").innerHTML = "Nombres";
            document.getElementById("component_apellido").style.display = "";
            document.getElementById("doc_select").required = "true";
            document.getElementById("apellido_input").required = true;
            document.getElementById("documentacion").required = true;
            document.getElementById("doc_select").style.display = "";
           document.getElementById("nombre").setAttribute("pattern", "[A-Z a-z]+");
        }
    }

$('#myModal').on('hidden.bs.modal', function(){
    error_cedula.style.display = "none";
    $(this).find('form')[0].reset();
});