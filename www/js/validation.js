
//check if there is a match between a password and re-enter the password
$(document).ready(function() {

    $('form').on('submit', function() {
        $('.error').removeClass('error');

        var isValidForm = true;
        var pass1 = $('#password1');
        var pass2 = $('#password2');
        var html = '<span>Re-enter password must match password input</span>';
        html = $(html);

        if(pass1.val() != pass2.val()) {
            isValidForm = false;
            pass1.addClass('error');
            pass2.addClass('error');
            $('.pass').append(html);
        }
        return isValidForm;
    });
});







