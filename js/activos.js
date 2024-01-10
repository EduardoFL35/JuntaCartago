function funcion_modal_editar_activo (){
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
                        jQuery("#nombre_factura_editar").val(data);
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
        formData.append("imagen_activo_p",file);//
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
                        jQuery("#nombre_imagen_editar").val(data);
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
    
    //Agregar Activo
    jQuery("#activo_form_editar").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var codigo_activo_editar = jQuery("#codigo_activo_editar").val();
        var nombre_activo_editar = jQuery("#nombre_activo_editar").val();
        var desc_activo_editar = jQuery("#desc_activo_editar").val();
        var color_activo_editar = jQuery("#color_activo_editar").val();
        var monto_activo_editar = jQuery("#monto_activo_editar").val();
        var cantidad_activo_editar = jQuery("#cantidad_activo_editar").val();
        var cantidad_minima_activo_editar = jQuery("#cantidad_activo_editar").val();
        var fecha_inicio_activo_editar = jQuery("#fecha_inicio_activo_editar").val();
        var fecha_final_activo_editar = jQuery("#fecha_final_activo_editar").val();
        var estado_activo_editar = jQuery("#estado_activo_editar").val();
        var nota_activo_editar = jQuery("#nota_activo_editar").val();
        var nombre_imagen_editar = jQuery("#nombre_imagen_editar").val();
        var nombre_factura_editar = jQuery("#nombre_factura_editar").val();
        var id_activo_editar = jQuery("#id_activo_editar").val();
        jQuery("#codigo_activo_editar").css("border", "");
        jQuery("#nombre_activo_editar").css("border", "");
        jQuery("#desc_activo_editar").css("border", "");
        jQuery("#color_activo_editar").css("border", "");
        jQuery("#monto_activo_editar").css("border", "");
        jQuery("#cantidad_activo_editar").css("border", "");
        jQuery("#cantidad_minima_activo_editar").css("border", "");
        jQuery("#fecha_inicio_activo_editar").css("border", "");
        jQuery("#fecha_final_activo_editar").css("border", "");
        jQuery("#estado_activo_editar").css("border", "");
        jQuery("#nota_activo_editar").css("border", "");

        if (codigo_activo_editar == "") {
            jQuery("#codigo_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (nombre_activo_editar == "") {
            jQuery("#nombre_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (desc_activo_editar == "") {
            jQuery("#desc_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (color_activo_editar == "") {
            jQuery("#color_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (monto_activo_editar == "") {
            jQuery("#monto_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (cantidad_activo_editar == "") {
            jQuery("#cantidad_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (cantidad_minima_activo_editar == "") {
            jQuery("#cantidad_minima_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (fecha_inicio_activo_editar == "") {
            jQuery("#fecha_inicio_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (fecha_final_activo_editar == "") {
            jQuery("#fecha_final_activo_editar").css("border", "2px solid red");
            return false;
        }
        if (estado_activo_editar == "") {
            jQuery("#estado_activo_editar").css("border", "2px solid red");
            return false;
        }

        if (nombre_imagen_editar === "") {
            alert("Falta subir la imagen");
            return false;
        }
        if (nombre_factura_editar === "") {
            alert("Falta subir la factura");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AActivos",
			dataType:"text",
			data:{
                
                key_editar_activo: "edit_activo",
                id_activo_editar: id_activo_editar,
                codigo_activo_editar : codigo_activo_editar,
                nombre_activo_editar : nombre_activo_editar,
                desc_activo_editar : desc_activo_editar,
                color_activo_editar : color_activo_editar,  
                monto_activo_editar : monto_activo_editar,  
                cantidad_activo_editar : cantidad_activo_editar,
                cantidad_minima_activo_editar : cantidad_minima_activo_editar,
                fecha_inicio_activo_editar : fecha_inicio_activo_editar,
                fecha_final_activo_editar : fecha_final_activo_editar,
                estado_activo_editar : estado_activo_editar,
                nota_activo_editar : nota_activo_editar,
                nombre_imagen_editar : nombre_imagen_editar,
                nombre_factura_editar : nombre_factura_editar
			},             
			success:function(ndata){  
                console.log(ndata);
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_registro").addClass("alert alert-success")
                        jQuery("#alerta_registro").html("¡Se actualizó un activo correctamente!")
                        var alertaRegistro = document.getElementById("alerta_registro");
                        alertaRegistro.scrollIntoView({ behavior: "smooth" });

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
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

}

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
                        var alertaRegistro = document.getElementById("alerta_registro");
                        alertaRegistro.scrollIntoView({ behavior: "smooth" });

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
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

    
    //Añadir una nota
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
        formData.append("imagen_activo_p",file);//
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

    //Elimminar Activos
    jQuery(".eliminar").click(function(){/*Acordarse que esto indica la clase a la que se le da click*/
    var id_activo = jQuery(this).attr("data-id");
    jQuery.ajax({
        type: "POST", 
        url: "../../ajax/AActivos",
        dataType:"text",
        data:{
            key_eliminar_activo: "eliminar_activo",
            id_activo: id_activo
        },             
        success:function(ndata){  
            switch (ndata) {
                case "1":
                    jQuery("#alerta_eliminar").addClass("mx-2 my-1 alert alert-success")
                    jQuery("#alerta_eliminar").html("¡Se eliminó un activo correctamente!")
                    var alertaEliminarElement = document.getElementById("alerta_eliminar");
                    alertaEliminarElement.scrollIntoView({ behavior: "smooth" });
                    
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
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

    //Editar Activo
    jQuery(".editar-activo-btn").click(function(){
        var id_edit_activo = jQuery(this).attr("data_id");
        jQuery.ajax({
			type: "POST", 
			url: "../../ajax/AActivos",
			dataType:"text",
			data:{
				key_editar: "editar_activo",
				id_edit_activo: id_edit_activo
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "a":
                        jQuery("#action").html("<p>Error al insertar datos</p>")
                        break;    
                    default:
                        console.log(ndata);
                        jQuery("#modal_ajax").html(ndata);
                        funcion_modal_editar_activo();
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