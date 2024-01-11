jQuery(document).ready( function () {
    console.log("Cargó el JS")
    //Agregar Documentos
    jQuery("#orden_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var tipo_orden = jQuery("#tipo_orden").val();
        var estado_factura = jQuery("#estado_factura").val();
        var fecha_orden = jQuery("#fecha_orden").val();
        var procedencia_orden = jQuery("#procedencia_orden").val();
        //var nombre_archivo = jQuery("#nombre_archivo").val();
        var desc_orden = jQuery("#desc_orden").val();
        jQuery("#tipo_orden").css("border", "");
        jQuery("#estado_factura").css("border", "");
        jQuery("#fecha_orden").css("border", "");
        jQuery("#procedencia_orden").css("border", "");
        //jQuery("#nombre_archivo").css("border", "");
        jQuery("#desc_orden").css("border", "");
        if (tipo_orden == "") {
            jQuery("#tipo_orden").css("border", "2px solid red");
            return false;
        }
        if (estado_factura == "") {
            jQuery("#estado_factura").css("border", "2px solid red");
            return false;
        }
        if (fecha_orden == "") {
            jQuery("#fecha_orden").css("border", "2px solid red");
            return false;
        }
        if (procedencia_orden == "") {
            jQuery("#procedencia_orden").css("border", "2px solid red");
            return false;
        }
        // if (nombre_archivo == "") {
        //     alert("Falta subir el archivo");
        //     return false;
        // }
        if (desc_orden == "") {
            jQuery("#desc_orden").css("border", "2px solid red");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AOrdenes_de_Compra",
			dataType:"text",
			data:{
				key_registro_orden: "registro_orden",
				tipo_orden: tipo_orden,
                estado_factura: estado_factura,
                fecha_orden: fecha_orden,
                procedencia_orden: procedencia_orden,
                //nombre_archivo : nombre_archivo,
                desc_orden: desc_orden
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_registro").addClass("alert alert-success")
                        jQuery("#alerta_registro").html("¡Se guardó un documento correctamente!")
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
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