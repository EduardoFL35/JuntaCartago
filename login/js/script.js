jQuery(document).ready(function(){
    console.log("Cargó el JS");
    //Login
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
                        location.href ='http://localhost/Proyecto/Git/JuntaCartago/';
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
    
    //Registro
    jQuery("#registro_usr").submit(function(){
        var nombre_usr = jQuery("#nombre_usr").val();
        var apellido_usr = jQuery("#apellido_usr").val();
        var cedula_usr = jQuery("#cedula_usr").val();
        var correo_usr = jQuery("#correo_usr").val();
        var password_usr = jQuery("#password_usr").val();
        jQuery("#nombre_usr").css("border",""); 
        jQuery("#apellido_usr").css("border","");
        jQuery("#cedula_usr").css("border",""); 
        jQuery("#correo_usr").css("border","");
        jQuery("#password_usr").css("border","");
        jQuery("#res_registro").html("");

        if (nombre_usr == "") {
            jQuery("#nombre_usr").css("border","2px solid red"); 
            return false;         
        }

        if (apellido_usr == "") {
            jQuery("#apellido_usr").css("border","2px solid red");   
            return false;       
        }

        if (cedula_usr == "") {
            jQuery("#cedula_usr").css("border","2px solid red"); 
            return false;         
        }

        if (correo_usr == "") {
            jQuery("#correo_usr").css("border","2px solid red");   
            return false;       
        }

        if (password_usr == "") {
            jQuery("#password_usr").css("border","2px solid red");   
            return false;       
        }
        
        jQuery.ajax({
			type: "POST", 
			url: "../ajax/AUsuarios.php",
			dataType:"text",
			data:{
				key: "registro",
                nombre_usr : nombre_usr,
                apellido_usr : apellido_usr,
                cedula_usr : cedula_usr,
                correo_usr : correo_usr,
                password_usr : password_usr
			},             
			success:function(ndata){  
				switch (ndata) {
                    case "1":
                        location.href ='http://localhost/Proyecto/Git/JuntaCartago/login/';
                        break;

                    case "a":
                        jQuery("#res_res_registroajax").html("<p>Error al registrarse</p>");
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

