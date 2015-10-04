<?php
$title = 'Registration';
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('templates/header.php');
require_once('lib/businessLogic.php');

if (isset($_SESSION['loggedInUser'])) {
    redirect('/index.php');
}

?>
    <main>
        <div class="registration-form">

            <h1>Sign Up
                <small>You're welcome to join us</small>
            </h1>
            <form enctype="multipart/form-data" method="post" id="registration">
                <div class="errors" id="empty-error"></div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="u_email" id="email" placeholder="Email" required
                           autofocus="true">
                </div>
                <div class="errors" id="email-error"></div>

                <div class="form-group pass">
                    <label for="password1">Password</label>
                    <input type="password" class="form-control" name=" u_password" id="password1" placeholder="Password"
                           required pattern="[a-zA-Z0-9]+">
                </div>
                <div class="errors" id="password-error"></div>

                <div class="form-group">
                    <label for="password2">Re-enter Password</label>
                    <input type="password" class="form-control" id="password2" placeholder="Re-enter Password" required>
                </div>

                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" name=" u_nickname" id="nickname" placeholder="Nickname"
                           required>
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" class="form-control" name=" u_birthdate" id="birthdate" required>
                </div>

                <div class="form-group">
                    <label for="about">About Myself</label>
                    <textarea class="form-control" name=" u_about_myself" id="about"></textarea>
                </div>

                <div class="form-group">
                    <label for="file1">File input</label>
                    <input type="file" id="file1" name="file1">
                </div>
                <div class="form-group">
                    <label for="file2">File input</label>
                    <input type="file" id="file2" name="file2">
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>


        </div>

    </main>

<?php

require_once('templates/footer.php');
?>