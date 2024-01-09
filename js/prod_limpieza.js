jQuery(document).ready( function () {
    console.log("Cargó el JS de Productos de Limpieza")

    //Agregar Producto
    jQuery("#producto_limpieza_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var nombre_producto = jQuery("#nombre_producto").val();
        var precio_producto = jQuery("#precio_producto").val();
        var cantidad_producto = jQuery("#cantidad_producto").val();
        var cantidad_minima_producto = jQuery("#cantidad_minima_producto").val();
        var factura_producto = jQuery("#factura_producto").val();
        var imagen_producto = jQuery("#imagen_producto").val();
        var desc_producto = jQuery("#desc_producto").val();
        jQuery("#nombre_producto").css("border", "");
        jQuery("#precio_producto").css("border", "");
        jQuery("#cantidad_producto").css("border", "");
        jQuery("#cantidad_minima_producto").css("border", "");
        jQuery("#factura_producto").css("border", "");
        jQuery("#imagen_producto").css("border", "");
        jQuery("#desc_producto").css("border", "");
        
        if (nombre_producto == "") {
            jQuery("#nombre_producto").css("border", "2px solid red");
            return false;
        }
        if (precio_producto == "") {
            jQuery("#precio_producto").css("border", "2px solid red");
            return false;
        }
        if (cantidad_producto == "") {
            jQuery("#cantidad_producto").css("border", "2px solid red");
            return false;
        }
        if (cantidad_minima_producto == "") {
            jQuery("#cantidad_minima_producto").css("border", "2px solid red");
            return false;
        }
        if (desc_producto == "") {
            jQuery("#desc_producto").css("border", "2px solid red");
            return false;
        }

        if (factura_producto == "") {
            alert("Falta subir la factura");
            return false;
        }
        if (imagen_producto == "") {
            alert("Falta subir la imagen"); 
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AProd_Limpieza",
			dataType:"text",
			data:{
				key_registro_producto: "key_registro_producto",
                nombre_producto : nombre_producto,
                precio_producto : precio_producto,
                cantidad_producto : cantidad_producto,
                cantidad_minima_producto : cantidad_minima_producto,  
                factura_producto : factura_producto,  
                imagen_producto : imagen_producto,
                desc_producto : desc_producto
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_registro").addClass("alert alert-success")
                        jQuery("#alerta_registro").html("¡Se guardó un producto correctamente!")
                        
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

    //Agregar una nota
    jQuery("#nota_limpieza_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
        var id_producto = jQuery(this).attr("data-id");
        var message_limpieza = jQuery("#message_limpieza").val();
        jQuery("#message_limpieza").css("border", "");
        
        if (message_limpieza == "") {
            jQuery("#message_limpieza").css("border", "2px solid red");
            return false;
        }
        
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AProd_Limpieza",
			dataType:"text",
			data:{
				key_nota_producto: "key_nota_producto",
                message_limpieza : message_limpieza,
                id_producto : id_producto
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_nota").addClass("alert alert-success")
                        jQuery("#alerta_nota").html("¡Se guardó un producto correctamente!")
                        
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                        break;

                    case "a":
                        jQuery("#alerta_nota").addClass("alert alert-danger")
                        jQuery("#alerta_nota").html("¡Error al ingresar datos!")
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

    //Elimminar producto
    jQuery(".eliminar").click(function(){/*Acordarse que esto indica la clase a la que se le da click*/
    var id_producto = jQuery(this).attr("data-id");
    jQuery.ajax({
        type: "POST", 
        url: "../../ajax/AProd_Limpieza",
        dataType:"text",
        data:{
            key_eliminar_producto: "eliminar_producto",
            id_producto: id_producto
        },             
        success:function(ndata){  
            switch (ndata) {
                case "1":
                    jQuery("#alerta_eliminar").addClass("mx-2 my-1 alert alert-success")
                    jQuery("#alerta_eliminar").html("¡Se eliminó un producto correctamente!")
                    var alertaEliminarElement = document.getElementById("alerta_eliminar");
                    alertaEliminarElement.scrollIntoView({ behavior: "smooth" });
                    
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                    break;

                case "a":
                    jQuery("#alerta_eliminar").addClass("alert alert-danger")
                    jQuery("#alerta_eliminar").html("¡Error al ingresar datos!")
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