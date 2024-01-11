function funcion_modal_editar_tipo (){
    jQuery("input[name='archivo']").on("change", function(){
        jQuery("#msg_error").html("");
        jQuery("#msg_error").hide();
        //queremos que esta variable sea global
        var fileExtension = "";
        //obtenemos un array con los datos del archivo
        var file = jQuery("#archivo")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;

        var formData = new FormData();
        formData.append("archivo",file);
        var message = "";

        jQuery.ajax({
            url: "../../ajax/ATipoDoc",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:formData,
            beforeSend: function(){
                // mensaje cuando se esta cargando imagen para enviar.
                jQuery("#msg_error").show();
                jQuery("#msg_error").html("<span class='before'>Subiendo el archivo, por favor espere...</span>");
                console.log('Cargando archivo');
            },
            // una vez finalizado correctamente
            success: function(data){
                switch(data){
                    case "a":
                        console.log("Error al cargar el archivo");
                        break;
                    default:
                        jQuery("#nombre_archivo_editar").val(data);
                        console.log("cargó el archivo" + data);
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
    
    jQuery("#documento_form_editar_tipo").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var nombre_doc_editar = jQuery("#nombre_doc_editar").val();
        var fecha_doc_editar = jQuery("#fecha_doc_editar").val();
        var tipo_doc_editar = jQuery("#tipo_doc_editar").val();
        var desc_doc_editar = jQuery("#desc_doc_editar").val();
        var nombre_archivo_editar = jQuery("#nombre_archivo_editar").val();
        var tipo_procedencia_editar = jQuery("#tipo_procedencia_editar").val();
        var id_documento_editar = jQuery("#id_documento_editar").val(); 
        jQuery("#nombre_doc_editar").css("border", "");
        jQuery("#fecha_doc_editar").css("border", "");
        jQuery("#tipo_doc_editar").css("border", "");
        jQuery("#desc_doc_editar").css("border", "");
        jQuery("#tipo_procedencia_editar").css("border", "");

        if (nombre_doc_editar == "") {
            jQuery("#nombre_doc_editar").css("border", "2px solid red");
            return false;
        }
        if (fecha_doc_editar == "") {
            jQuery("#fecha_doc_editar").css("border", "2px solid red");
            return false;
        }
        if (tipo_doc_editar == "") {
            jQuery("#tipo_doc_editar").css("border", "2px solid red");
            return false;
        }
        if (desc_doc_editar == "") {
            jQuery("#desc_doc_editar").css("border", "2px solid red");
            return false;
        }
        if (nombre_archivo_editar == "") {
            alert("Falta subir el archivo");
            return false;
        }
        if (tipo_procedencia_editar == "") {
            jQuery("#tipo_procedencia_editar").css("border", "2px solid red");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../../ajax/ATipo_Doc",
			dataType:"text",
			data:{
				key_editar_registro: "editar_registro_doc",
				nombre_doc_editar: nombre_doc_editar,
                fecha_doc_editar: fecha_doc_editar,
                tipo_doc_editar: tipo_doc_editar,
                desc_doc_editar: desc_doc_editar,
                nombre_archivo_editar : nombre_archivo_editar,
                id_documento_editar : id_documento_editar,
                tipo_procedencia_editar : tipo_procedencia_editar
			},             
			success:function(ndata){  
                console.log("->" + ndata);
                
				switch (ndata) {
                    case "1":
                        jQuery("#alerta_registro").addClass("alert alert-success")
                        jQuery("#alerta_registro").html("¡Se guardó un documento correctamente!")
                        
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
}

jQuery(document).ready( function () {
    console.log("Cargó el JS de Tipos")
    //Editar Producto
    jQuery(".editar-tipo-btn").click(function(){
        var id_edit_tipo = jQuery(this).attr("data_id");
        jQuery.ajax({
			type: "POST", 
			url: "../../ajax/ATipo_Doc",
			dataType:"text",
			data:{
				key_editar : "editar_tipo",
				id_edit_tipo : id_edit_tipo
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "a":
                        jQuery("#action").html("<p>Error al insertar datos</p>")
                        break;    
                    default:
                        console.log(ndata);
                        jQuery("#modal_ajax").html(ndata);
                        funcion_modal_editar_tipo();
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