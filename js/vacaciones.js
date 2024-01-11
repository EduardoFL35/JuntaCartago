jQuery(document).ready( function () {
    console.log("Cargó el JS")
    //Agregar Documentos
    jQuery("#vacaciones_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var usuario_vacaciones= jQuery("#usuario_vacaciones").val();
        var fecha_entrada = jQuery("#fecha_entrada").val();    
        var fecha_salida = jQuery("#fecha_salida").val();

        jQuery("#usuario_vacaciones").css("border", "");
        jQuery("#fecha_entrada").css("border", "");
        jQuery("#fecha_salida").css("border", "");

        if (usuario_vacaciones == "") {
            jQuery("#usuario_vacaciones").css("border", "2px solid red");
            return false;
        }
        if (fecha_entrada == "") {
            jQuery("#fecha_entrada").css("border", "2px solid red");
            return false;
        }

        if (fecha_salida == "") {
            jQuery("#fecha_salida").css("border", "2px solid red");
            return false;
        }

        
		jQuery.ajax({
			type: "POST", 
			url: "../ajax/AVacaciones",
			dataType:"text",
			data:{
				key_vacaciones: "registro_vacaciones",
				usuario_vacaciones: usuario_vacaciones,
                fecha_entrada: fecha_entrada,
                fecha_salida: fecha_salida
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_registro").addClass("alert alert-success")
                        jQuery("#alerta_registro").html("¡Su solicitud se envió correctamente y queda pendiente a revisión!")
                        var alertaRegistro = document.getElementById("alerta_registro");
                        alertaRegistro.scrollIntoView({ behavior: "smooth" });

                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                        break;
                        break;

                    case "a":
                        jQuery("#alerta_registro").addClass("alert alert-danger")
                        jQuery("#alerta_registro").html("¡Error al ingresar datos!")
                        break;    
                
                    default:
                        break;
                }                     
			},
			error:function (xhr, ajaxOptions, thrownError){                 
				alert(thrownError);
			} 
		});
        return false;
	});
});