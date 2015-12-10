
$(document).ready(function() {

    //add new post
    $("#new-post").submit(function(e) {
        e.preventDefault();
        var text = $("[name=p_text]", this).val(),
            data2send = {
                p_text: text,
                action: "post"
            };

        var successCallback = function(serverResult) {
            if (serverResult) {
                var date = new Date(),
                    day = date.getDate(),
                    month = date.getMonth() + 1,
                    year = date.getFullYear(),
                    hour = date.getHours(),
                    minutes = date.getMinutes(),
                    dateString = ("0" + day).slice(-2) + "/" + ("0" + month).slice(-2) + "/" + year + " " + hour + ":" + minutes,
                    post = $("<div><span>" + dateString + "</span><p>" + text + "</p></div>");

                $("[name=p_text]").val("");
                $("#new-post").after(post);
            }
        };

        $.post("/actions.php", data2send, successCallback, 'json');
    });


    var relationshipButtonsIndex = $('.buttons');

    //clicking on add friend button, send friend request and show request message. index page
    relationshipButtonsIndex.on('click', '[action=add]', function() {
        var id =  $('#u_id').val();
        var data2send = {
            u_id: id,
            action: "Add Friend"
        };
        var successCallback = function(serverResult) {
            if(serverResult) {
                var date = new Date(),
                    day = date.getDate(),
                    month = date.getMonth() + 1,
                    year = date.getFullYear(),
                    dateString = ("0" + day).slice(-2) + "/" + ("0" + month).slice(-2) + "/" + year;
                $('#add-friend').remove();
                var message = $("<span>Request was sent to user " + dateString + "</span>");
                $('.buttons').append(message);
            }
        };

        $.post("/actions.php", data2send, successCallback, 'json');
    });

    //clicking on accept button, show secret data and show unfriend button. index page
    relationshipButtonsIndex.on('click', '[action=accept]', function() {
        var u_id =  $('#u_id').val(),
            r_id =  $('#r_id').val(),
            data2send = {
                u_id: u_id,
                r_id: r_id,
                action: "Accept"
            };
        var successCallback = function(serverResult) {
            debugger;
            if(serverResult) {
                debugger;
                console.log(serverResult);
                var button = $('<input type="button" id="unfriend" name="action" class="btn btn-danger" action="unfriend" value="Unfriend">'),
                    imgSrc = serverResult['u_secret_pic'],
                    text = serverResult['u_about_myself'],
                    daysTillBirthday = serverResult['days'],
                    div = $('<div class="secret"><img src="' + imgSrc + '" width="170" height="235" alt="secret-picture">' +
                    '<div><p><span class="bold">About: </span>' + text + '</p><p><span class="bold">Your birthday in ' + daysTillBirthday +  ' days</span></p></div>');

                $('#accept-friendship').remove();
                $('#decline-friendship').remove();
                $('.buttons').append(button);
                $('#profile').prepend(div);

            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');

    });

    //clicking on decline button, show decline message. index page
    relationshipButtonsIndex.on('click', '[action=decline]', function() {
        var u_id =  $('#u_id').val(),
            r_id =  $('#r_id').val(),
            data2send = {
            u_id: u_id,
            r_id: r_id,
            action: "Decline"
        };
        var successCallback = function(serverResult) {
            if(serverResult) {
                var date = new Date(),
                    day = date.getDate(),
                    month = date.getMonth() + 1,
                    year = date.getFullYear(),
                    dateString = ("0" + day).slice(-2) + "/" + ("0" + month).slice(-2) + "/" + year,
                    message = $("<span>Friendship was declined " + dateString + "</span>");
                $('#accept-friendship').remove();
                $('#decline-friendship').remove();
                $('.buttons').append(message);
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');
    });

    //clicking on unfriend button, hide secret data and show add friend button. index page
    relationshipButtonsIndex.on('click', '[action=unfriend]',function() {
        var id =  $('#u_id').val();
        var data2send = {
            u_id: id,
            action: "Unfriend"
        };

        var successCallback = function(serverResult) {
            if(serverResult) {
                var button = $('<input type="button" id="add-friend" name="action" class="btn btn-default" action="add" value="Add Friend">');
                $('.buttons').append(button);
                $('#unfriend').remove();
                $('.secret').hide();
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');

    });

    var accountStatusButtons = $('#activate-buttons');

    //deactivate profile and add activation button
    accountStatusButtons.on('click', '[action=disable]', function() {
        var data2send = { action: "Deactivate profile" };
        var successCallback = function(serverResult) {
            if(serverResult) {
                $('#deactivate').remove();
                var button = $('<input type="button" id="activate-back" class="btn btn-default" name="action" action="enable" value="Activate profile">');
                $('#activate-buttons').append(button);
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');
    });

    //activate profile and add deactivation button
    accountStatusButtons.on('click', '[action=enable]',function() {
        var data2send = { action: "Activate profile" };
        var successCallback = function(serverResult) {
            if(serverResult) {
                $('#activate-back').remove();
                var button = $('<input type="button" id="deactivate" class="btn btn-danger" name="action" action="disable" value="Deactivate profile">');
                $('#activate-buttons').append(button);
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');
    });

    var requestDiv = $('#requests');
    var declinesDiv = $('#declines');
    var friendsDiv = $('#friends');

    //clicking on unfriend button remove the div from relationship page
    friendsDiv.on('click', '[action=unfriend]', function() {
        var id = $(this).parent().find('input[type=hidden]').val();
        var data2send = {
            u_id: id,
            action: "Unfriend"
        };
        var successCallback = function(serverResult) {
            if(serverResult) {
                var div = $('[u_id=' + serverResult + ']');
                div.remove();
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');
    });

    //when clicking on regret button the user will become a friend and move to the friends list. relationship page
    declinesDiv.on('click', '[action=regret]', function() {
        var id = $(this).parent().find('input[type=hidden]').val(),
            data2send = {
                u_id: id,
                action: "Regret button"
            };
        var successCallback = function(serverResult) {
            if(serverResult) {
                var div = $('[u_id=' + serverResult + ']'),
                    form = $('form', div),
                    button = $('<input type="button" class="btn btn-danger" name="action" value="Unfriend"  action="unfriend">');

                div.find('input[type=button]').remove();
                form.append(button);
                div.remove();
                friendsDiv.prepend(div);
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');

    });
    //when clicking on decline button the user will move to the decline list. relationship page
    requestDiv.on('click', '[action=decline]', function() {
        var r_id = $(this).parent().find('.r_id').val(),
            u_id = $(this).parent().find('.u_id').val(),
            data2send = {
                u_id: u_id,
                r_id: r_id,
                action: "Decline"
            };
        var successCallback = function(serverResult) {
            if(serverResult) {
                var div = $('[u_id=' + serverResult + ']'),
                    form = $('form', div),
                    button = $('<input type="button" class="btn btn-default" name="action" value="Regret button" action="regret">');

                div.find('input[type=button]').remove();
                form.append(button);
                div.remove();
                declinesDiv.prepend(div);
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');

    });
    //when clicking on accept button the user will move to friend list. relationship page
    requestDiv.on('click', '[action=accept]', function() {
        var r_id = $(this).parent().find('.r_id').val(),
            u_id = $(this).parent().find('.u_id').val(),
            data2send = {
                r_id: r_id,
                u_id: u_id,
                action: "Accept"
            };
        var successCallback = function(serverResult) {
            if(serverResult) {
                var user_id = serverResult.u_id;
                var div = $('[u_id=' + user_id + ']'),
                    form = $('form', div),
                    button = $('<input type="button" class="btn btn-danger" name="action" value="Unfriend"  action="unfriend">');

                div.find('input[type=button]').remove();
                form.append(button);
                div.remove();
                friendsDiv.prepend(div);
            }
        };
        $.post("/actions.php", data2send, successCallback, 'json');

    });



    //form filling, register new user or update existing user info
    $('#registration, #userinfo').submit(function(e) {
        e.preventDefault();

        var formData = new FormData();

        formData.append("action", "Form Filling");
        formData.append("u_email", $('#email').val());
        formData.append("u_password", $('#password1').val());
        formData.append("u_nickname", $('#nickname').val());
        formData.append("u_birthdate", $('#birthdate').val());
        formData.append("u_about_myself", $('#about').val());

        formData.append('file1', $('#file1')[0].files[0]);
        formData.append('file2', $('#file2')[0].files[0]);
        var id = $('#id').val();
        if(id != undefined) {
            formData.append("u_id", id);
        }


        var successCallback = function(serverResult) {
            serverResult = JSON.parse(serverResult);
            if(serverResult) {

                $('.errors').empty();
                //when registration is valid server result is user object. if so, redirect to index page
                if(serverResult['u_id'] != undefined) {
                    $(location).attr('href', '/index.php');
                }
                //if registration isn't valid the result is error object which include several error messages
                if(serverResult['non_empty'] != undefined) {
                    var emptyMessage = $("<span>" + serverResult['non_empty'] + "</span>");
                    $('#empty-error').html(emptyMessage);
                }
                if(serverResult['u_password'] != undefined) {
                    var passwordMessage = $("<span>" + serverResult['u_password'] + "</span>");
                    $('#password-error').html(passwordMessage);
                }

                if(serverResult['u_email'] != undefined) {
                    var uniqueEmailMessage = $("<span>" + serverResult['u_email'] + "</span>");
                    $('#email-error').html(uniqueEmailMessage);
                }

            }
        };


        $.ajax({
            url: "/actions.php",
            data: formData,
            success: successCallback,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST'
        });

    });


});



