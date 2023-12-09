jQuery(document).ready(function(){
    console.log("Admin del sistema");

    jQuery("#cerrar").click(function(){

        jQuery.ajax({
			type: "POST", 
			url: "ajax/AUsuarios.php",
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
    
});

