jQuery(document).ready( function () {
    console.log("Cargó el JS")
    //Agregar Documentos
    jQuery("#documento_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var nombre_doc = jQuery("#nombre_doc").val();
        var fecha_doc = jQuery("#fecha_doc").val();
        var tipo_doc = jQuery("#tipo_doc").val();
        var desc_doc = jQuery("#desc_doc").val();
        var nombre_archivo = jQuery("#nombre_archivo").val();
        jQuery("#nombre_doc").css("border", "");
        jQuery("#fecha_doc").css("border", "");
        jQuery("#tipo_doc").css("border", "");
        jQuery("#desc_doc").css("border", "");

        if (nombre_doc == "") {
            jQuery("#nombre_doc").css("border", "2px solid red");
            return false;
        }
        if (fecha_doc == "") {
            jQuery("#fecha_doc").css("border", "2px solid red");
            return false;
        }
        if (tipo_doc == "") {
            jQuery("#tipo_doc").css("border", "2px solid red");
            return false;
        }
        if (desc_doc == "") {
            jQuery("#desc_doc").css("border", "2px solid red");
            return false;
        }
        if (nombre_archivo == "") {
            alert("Falta subir el archivo");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../ajax/ADocumentos",
			dataType:"text",
			data:{
				key_registro: "registro_doc",
				nombre_doc: nombre_doc,
                fecha_doc: fecha_doc,
                tipo_doc: tipo_doc,
                desc_doc: desc_doc,
                nombre_archivo : nombre_archivo
			},             
			success:function(ndata){  
                console.log(ndata);
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

	//Elimminar Documentos
    jQuery(".eliminar").click(function(){/*Acordarse que esto indica la clase a la que se le da click*/
    var id_documento = jQuery(this).attr("data-id");
    jQuery.ajax({
        type: "POST", 
        url: "../ajax/ADocumentos",
        dataType:"text",
        data:{
            key_eliminar: "eliminar_tarea",
            id_documento: id_documento
        },             
        success:function(ndata){  
            switch (ndata) {
                case "1":
                    jQuery(".btn_eliminar").next().html("<p>Se eliminó una tarea</p>")
                    //Agregar <tr> del dato nuevo
                    //Hacer un refrescar de la página
                    location.reload();
                    break;

                case "a":
                    jQuery(".btn_eliminar").next().html("<p>Error al eliminar datos</p>")
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

    //Editar Documento
    jQuery(".editar-btn").click(function(){
        var id_edit = jQuery(this).attr("data_id");
        jQuery.ajax({
			type: "POST", 
			url: "../ajax/ADocumentos",
			dataType:"text",
			data:{
				key_editar: "editar_documento",
				id_edit: id_edit
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "a":
                        jQuery("#action").html("<p>Error al insertar datos</p>")
                        break;    
                    default:
                        console.log(ndata);
                        jQuery("#modal_ajax").html(ndata);
                        break;
                }                     
			},
			error:function (xhr, ajaxOptions, thrownError){                 
				alert(thrownError);
			} 
		});
        return false;
    });

    //Guardar Documento
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
            url: "../ajax/ADocumentos",
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
                        jQuery("#nombre_archivo").val(data);
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

    //Cerrar sesion
    jQuery("#cerrar").click(function(){

        jQuery.ajax({
			type: "POST", 
			url: "../ajax/AUsuarios.php",
			dataType:"text",
			data:{
				key: "cerrar_sesion"
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "1":
                        location.href ='http://localhost/Proyecto/Git/JuntaCartago/';
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

    jQuery(".eliminar_control").click(function(){/*Acordarse que esto indica la clase a la que se le da click*/
    var id_control = jQuery(this).attr("data-id");
    jQuery.ajax({
        type: "POST", 
        url: "../ajax/ADocumentos",
        dataType:"text",
        data:{
            key_eliminar_control: "eliminar_control",
            id_control: id_control
        },             
        success:function(ndata){  
            switch (ndata) {
                case "1":
                    jQuery(".btn_eliminar_control").next().html("<p>Se eliminó una tarea</p>")
                    //Agregar <tr> del dato nuevo
                    //Hacer un refrescar de la página
                    location.reload();
                    break;

                case "a":
                    jQuery(".btn_eliminar_control").next().html("<p>Error al eliminar datos</p>")
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