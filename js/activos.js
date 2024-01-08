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
        var nombre_imagen = jQuery("#nombre_imagen").val();
        var nombre_factura = jQuery("#nombre_factura").val();
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

        if (nombre_imagen === "") {
            alert("Falta subir la imagen");
            return false;
        }
        if (nombre_factura === "") {
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

    

    jQuery(".nota_activo_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
           
        var id_activo = jQuery(this).attr("data-id");
        var message_activo = jQuery("#message_activo_" + id_activo).val();
        jQuery("#message_activo_" + id_activo).css("border", "");
        
        if (message_activo == "") {
            jQuery("#message_activo_" + id_activo).css("border", "2px solid red");
            return false;
        }
        
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AActivos",
			dataType:"text",
			data:{
				key_nota_activo: "key_nota_activo",
                id_activo : id_activo,
                message_activo : message_activo
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_nota_" + id_activo).addClass("mx-2 my-1 alert alert-success")
                        jQuery("#alerta_nota_" + id_activo).html("¡Se guardó un activo correctamente!")
                        
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                        break;

                    case "a":
                        jQuery("#alerta_nota_"+ id_activo).addClass("alert alert-danger")
                        jQuery("#alerta_nota_"+ id_activo).html("¡Error al ingresar datos!")
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
    jQuery("input[name='factura_activo']").on("change", function(){
        jQuery("#msg_error").html("");
        jQuery("#msg_error").hide();
        //queremos que esta variable sea global
        var fileExtension = "";
        //obtenemos un array con los datos del archivo
        var file = jQuery("#factura_activo")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;

        var formData = new FormData();
        formData.append("factura_activo",file);
        var message = "";

        jQuery.ajax({
            url: "../../ajax/AActivos",
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
                        console.log("Error al cargar la factura");
                        break;
                    default:
                        jQuery("#nombre_factura").val(data);
                        console.log("cargó la factura" + data);
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
    jQuery("input[name='imagen_activo']").on("change", function(){
        jQuery("#msg_error").html("");
        jQuery("#msg_error").hide();
        //queremos que esta variable sea global
        var fileExtension = "";
        //obtenemos un array con los datos del archivo
        var file = jQuery("#imagen_activo")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;

        var formData = new FormData();
        formData.append("imagen_activo",file);
        var message = "";

        jQuery.ajax({
            url: "../../ajax/AActivos",
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

});