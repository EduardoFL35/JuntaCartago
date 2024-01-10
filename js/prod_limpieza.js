jQuery(document).ready( function () {
    console.log("Cargó el JS de Productos de Limpieza")

    //Agregar Producto
    jQuery("#producto_limpieza_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var nombre_producto = jQuery("#nombre_producto").val();
        var precio_producto = jQuery("#precio_producto").val();
        var cantidad_producto = jQuery("#cantidad_producto").val();
        var cantidad_minima_producto = jQuery("#cantidad_minima_producto").val();
        var nombre_factura = jQuery("#nombre_factura").val();
        var nombre_imagen = jQuery("#nombre_imagen").val();
        var desc_producto = jQuery("#desc_producto").val();
        jQuery("#nombre_producto").css("border", "");
        jQuery("#precio_producto").css("border", "");
        jQuery("#cantidad_producto").css("border", "");
        jQuery("#cantidad_minima_producto").css("border", "");
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

        if (nombre_factura == "") {
            alert("Falta subir la factura");
            return false;
        }
        if (nombre_imagen == "") {
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
                nombre_factura : nombre_factura,  
                nombre_imagen : nombre_imagen,
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

    //Guardar Factura
    jQuery("input[name='factura_producto']").on("change", function(){
        jQuery("#msg_error").html("");
        jQuery("#msg_error").hide();
        //queremos que esta variable sea global
        var fileExtension = "";
        //obtenemos un array con los datos del archivo
        var file = jQuery("#factura_producto")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;

        var formData = new FormData();
        formData.append("factura_producto",file);
        var message = "";

        jQuery.ajax({
            url: "../../ajax/AProd_Limpieza",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            beforeSend: function(){
                // mensaje cuando se esta cargando imagen para enviar.
                jQuery("#msg_error").show();
                jQuery("#msg_error").html("<span class='before'>Subiendo la factura, por favor espere...</span>");
                console.log('Cargando factura');
            },
            // una vez finalizado correctamente
            success: function(data){
                switch(data){
                    case "a":
                        console.log("Error al cargar la imagen");
                        break;
                    default:
                        jQuery("#nombre_factura").val(data);
                        console.log("cargó la imagen" + data);
                        break;
                }
            },
            // si ha ocurrido un error
            error: function(){
                message = jQuery("<span class='error'>Ha ocurrido un error.</span>");
                console.log("Error");
            }
        });
    });

    //Guardar Imagen
    jQuery("input[name='imagen_producto']").on("change", function(){
        jQuery("#msg_error").html("");
        jQuery("#msg_error").hide();
        //queremos que esta variable sea global
        var fileExtension = "";
        //obtenemos un array con los datos del archivo
        var file = jQuery("#imagen_producto")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;

        var formData = new FormData();
        formData.append("imagen_producto",file);//
        var message = "";

        jQuery.ajax({
            url: "../../ajax/AProd_Limpieza",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            beforeSend: function(){
                // mensaje cuando se esta cargando imagen para enviar.
                jQuery("#msg_error").show();
                jQuery("#msg_error").html("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                console.log('Cargando imagen');
            },
            // una vez finalizado correctamente
            success: function(data){
                switch(data){
                    case "a":
                        console.log("Error al cargar imagen");
                        break;
                    default:
                        jQuery("#nombre_imagen").val(data);
                        console.log("cargó la imagen" + data);
                        break;
                }
            },
            // si ha ocurrido un error
            error: function(){
                message = jQuery("<span class='error'>Ha ocurrido un error.</span>");
                console.log("Error");
            }
        });
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