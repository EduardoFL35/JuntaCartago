jQuery(document).ready( function () {
    console.log("Cargó el JS e Solicitudes")
    //Agregar Documentos
    jQuery("#soli_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var nombre_soli = jQuery("#nombre_soli").val();
        var procedencia_soli = jQuery("#procedencia_soli").val();
        var desc_detallada_soli = jQuery("#desc_detallada_soli").val();
        var desc_fundamentada_soli = jQuery("#desc_fundamentada_soli").val();
        var nombre_archivo = jQuery("#nombre_imagen").val();
        var fecha_soli = jQuery("#fecha_soli").val();
        jQuery("#nombre_soli").css("border", "");
        jQuery("#procedencia_soli").css("border", "");
        jQuery("#desc_detallada_soli").css("border", "");
        jQuery("#desc_fundamentada_soli").css("border", "");
        jQuery("#fecha_soli").css("border", "");
        if (nombre_soli == "") {
            jQuery("#nombre_soli").css("border", "2px solid red");
            return false;
        }
        if (procedencia_soli == "") {
            jQuery("#procedencia_soli").css("border", "2px solid red");
            return false;
        }
        if (desc_detallada_soli == "") {
            jQuery("#desc_detallada_soli").css("border", "2px solid red");
            return false;
        }
        if (desc_fundamentada_soli == "") {
            jQuery("#desc_fundamentada_soli").css("border", "2px solid red");
            return false;
        }
        if (nombre_archivo == "") {
            alert("Falta subir el archivo");
            return false;
        }
        if (fecha_soli == "") {
            jQuery("#fecha_soli").css("border", "2px solid red");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "../ajax/ASolicitudes",
			dataType:"text",
			data:{
				key_registro_soli: "registro_soli",
				nombre_soli: nombre_soli,
                procedencia_soli: procedencia_soli,
                desc_detallada_soli: desc_detallada_soli,
                desc_fundamentada_soli: desc_fundamentada_soli,
                nombre_archivo : nombre_archivo,
                fecha_soli: fecha_soli
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
            url: "../ajax/ASolicitudes",
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