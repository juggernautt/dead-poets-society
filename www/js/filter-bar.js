
$(document).ready(function() {
    $('.find-friends').keyup(function() {
        var notFound = $('#no-found');
        notFound.hide();
        var filter = $(this).val().toLowerCase(),
            wasShownAtLeastOne = false;
        $('.user').each(function() {
            var nickname = $('.nickname', this).html().toLowerCase();
            if(nickname.indexOf(filter) == -1) {
                $(this).hide();
            } else {
                $(this).show();
                wasShownAtLeastOne = true;
            }
        });

        if(!wasShownAtLeastOne) {
            notFound.show();
        }
    });


    var users = $('.user').remove().toArray();


    function userCompareAsc (u1, u2) {
        if($('.nickname', u1).html() < $('.nickname', u2).html()) {
            return -1;
        }
        if($('.nickname', u1).html() == $('.nickname', u2).html()) {
            return 0;
        }
        if($('.nickname', u1).html() > $('.nickname', u2).html()) {
            return 1;
        }
    }

    function userCompareDesc (u1, u2) {
        if($('.nickname', u1).html() > $('.nickname', u2).html()) {
            return -1;
        }
        if($('.nickname', u1).html() == $('.nickname', u2).html()) {
            return 0;
        }
        if($('.nickname', u1).html() < $('.nickname', u2).html()) {
            return 1;
        }
    }

    var asc = $('#asc');
    asc.on('click', function() {
        users.sort(userCompareAsc);
        console.log(users);
        $('.center').append(users);
    });

    var desc = $('#desc');
    desc.on('click', function() {
        users.sort(userCompareDesc);
        console.log(users);
        $('.center').append(users);
    });

    asc.trigger('click');


});
