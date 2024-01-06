jQuery(document).ready( function () {
    console.log("Cargó el JS de Activos")

    //Agregar Activo
    jQuery("#activo_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var codigo_activo = jQuery("#codigo_activo").val();
        var nombre_activo = jQuery("#nombre_activo").val();
        var desc_activo = jQuery("#desc_activo").val();
        var color_activo = jQuery("#color_activo").val();
        var monto_activo = jQuery("#monto_activo").val();
        var cantidad_activo = jQuery("#cantidad_activo").val();
        var cantidad_minima_activo = jQuery("#cantidad_activo").val();
        var fecha_inicio_activo = jQuery("#fecha_inicio_activo").val();
        var fecha_final_activo = jQuery("#fecha_final_activo").val();
        var estado_activo = jQuery("#estado_activo").val();
        var nota_activo = jQuery("#nota_activo").val();
        var nombre_imagen = jQuery("#imagen").val();
        var nombre_factura = jQuery("#factura").val();
        jQuery("#codigo_activo").css("border", "");
        jQuery("#nombre_activo").css("border", "");
        jQuery("#desc_activo").css("border", "");
        jQuery("#color_activo").css("border", "");
        jQuery("#monto_activo").css("border", "");
        jQuery("#cantidad_activo").css("border", "");
        jQuery("#cantidad_minima_activo").css("border", "");
        jQuery("#fecha_inicio_activo").css("border", "");
        jQuery("#fecha_final_activo").css("border", "");
        jQuery("#estado_activo").css("border", "");
        jQuery("#nota_activo").css("border", "");

        if (codigo_activo == "") {
            jQuery("#codigo_activo").css("border", "2px solid red");
            return false;
        }
        if (nombre_activo == "") {
            jQuery("#nombre_activo").css("border", "2px solid red");
            return false;
        }
        if (desc_activo == "") {
            jQuery("#desc_activo").css("border", "2px solid red");
            return false;
        }
        if (color_activo == "") {
            jQuery("#color_activo").css("border", "2px solid red");
            return false;
        }
        if (monto_activo == "") {
            jQuery("#monto_activo").css("border", "2px solid red");
            return false;
        }
        if (cantidad_activo == "") {
            jQuery("#cantidad_activo").css("border", "2px solid red");
            return false;
        }
        if (cantidad_minima_activo == "") {
            jQuery("#cantidad_minima_activo").css("border", "2px solid red");
            return false;
        }
        if (fecha_inicio_activo == "") {
            jQuery("#fecha_inicio_activo").css("border", "2px solid red");
            return false;
        }
        if (fecha_final_activo == "") {
            jQuery("#fecha_final_activo").css("border", "2px solid red");
            return false;
        }
        if (estado_activo == "") {
            jQuery("#estado_activo").css("border", "2px solid red");
            return false;
        }

        if (nombre_imagen == "") {
            alert("Falta subir la imagen");
            return false;
        }
        if (nombre_factura == "") {
            alert("Falta subir la factura");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AActivos",
			dataType:"text",
			data:{
				key_registro_activo: "registro_activo",
                codigo_activo : codigo_activo,
                nombre_activo : nombre_activo,
                desc_activo : desc_activo,
                color_activo : color_activo,  
                monto_activo : monto_activo,  
                cantidad_activo : cantidad_activo,
                cantidad_minima_activo : cantidad_minima_activo,
                fecha_inicio_activo : fecha_inicio_activo,
                fecha_final_activo : fecha_final_activo,
                estado_activo : estado_activo,
                nota_activo : nota_activo,
                nombre_imagen : nombre_imagen,
                nombre_factura : nombre_factura
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_registro").addClass("alert alert-success")
                        jQuery("#alerta_registro").html("¡Se guardó un activo correctamente!")
                        
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
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