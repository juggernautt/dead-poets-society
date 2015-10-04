$(document).ready(function() {

    var email = $('input[type=email]'),
        password = $('input[type=password]'),
        form = $('form');

    $('#as-kafka').on('click', function() {
        email.val('franz@gmail.com');
        password.val('1234');
        form.trigger('submit');

    });

    $('#as-hemingway').on('click', function() {
        email.val('ernest@gmail.com');
        password.val('1234');
        form.trigger('submit');
    });
});
