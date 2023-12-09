jQuery(document).ready(function(){
    console.log("Si carga esta bomba");
    jQuery("#login_form").submit(function(){
        var cedula = jQuery("#cedula").val();
        var password = jQuery("#password").val();
        jQuery("#cedula").css("border",""); 
        jQuery("#password").css("border","");
        jQuery("#res_ajax").html("");

        if (cedula == "") {
            jQuery("#cedula").css("border","2px solid red"); 
            return false;         
        }

        if (password == "") {
            jQuery("#password").css("border","2px solid red");   
            return false;       
        }

        jQuery.ajax({
			type: "POST", 
			url: "../ajax/AUsuarios.php",
			dataType:"text",
			data:{
				key: "login",
				username: cedula,
                password: password
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "1":
                        location.href ='http://localhost/JuntaCartago/JuntaCartago/';
                        break;

                    case "a":
                        jQuery("#res_ajax").html("<p>Usuario no encontrado</p>");
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

