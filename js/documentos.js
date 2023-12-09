jQuery(document).ready( function () {
    console.log("Cargó el JS")

    jQuery("#cita_form").submit(function(){/*Acordarse que el # indica el id a la que se le da click*/
		var nombre_doc = jQuery("#nombre_doc").val();
        var fecha_doc = jQuery("#fecha_doc").val();
        var tipo_doc = jQuery("#tipo_doc").val();
        var desc_doc = jQuery("#desc_doc").val();
        var desc_doc = jQuery("#desc_doc").val();

        if (nombre_tarea == "") {
            jQuery("#nombre_tarea").css("border", "2px solid red");
            return false;
        }
        if (fecha_inicio == "") {
            jQuery("#fecha_inicio").css("border", "2px solid red");
            return false;
        }
        if (descripcion == "") {
            jQuery("#descripcion").css("border", "2px solid red");
            return false;
        }
        if (fecha_final == "") {
            jQuery("#fecha_final").css("border", "2px solid red");
            return false;
        }
        
		jQuery.ajax({
			type: "POST", 
			url: "./Ajax/ajax_tarea.php",
			dataType:"text",
			data:{
				key: "crear_tarea",
				nombre_tarea: nombre_tarea,
                fecha_inicio: fecha_inicio,
                descripcion: descripcion,
                fecha_final: fecha_final,
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "1":
                        jQuery("#action").next().html("<p>Se agregó una tarea</p>")
                        //Agregar <tr> del dato nuevo
                        //Hacer un refrescar de la página
                        location.reload();
                        break;

                    case "a":
                        jQuery("#action").next().html("<p>Error al ingresar datos</p>")
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
	
    jQuery(".eliminar").click(function(){/*Acordarse que esto indica la clase a la que se le da click*/
    var id_tarea = jQuery(this).attr("data-id");
    jQuery.ajax({
        type: "POST", 
        url: "./Ajax/ajax_tarea.php",
        dataType:"text",
        data:{
            key: "eliminar_tarea",
            id_tarea: id_tarea
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

    
});