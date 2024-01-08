$(document).ready(function() {
    // Selector del enlace del ojo
    var eyeIcon = $('.input-group-text a');

    eyeIcon.click(function() {
        // Selector del campo de contraseña
        var passwordField = $('#password');

        // Cambia el tipo de input para alternar entre texto y contraseña
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
        }

        // Cambia el icono del ojo
        eyeIcon.find('i').toggleClass('bi-eye bi-eye-slash');
    });
});