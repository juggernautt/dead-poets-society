<?php
$title = 'UserInfo';
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('templates/header.php');
require_once('lib/businessLogic.php');

if (isset($_SESSION['loggedInUser'])) {
    $user = selectUser($_SESSION['loggedInUser']['u_id']);
}

?>

    <script src="js/validation.js"></script>
    <main>

        <div class="registration-form">

            <div id="activate-buttons">
                <?php
                if (isDeactivated($_SESSION['loggedInUser']['u_id']) == 0) { ?>
                    <input type="button" id="deactivate" class="btn btn-danger" name="action" value="Deactivate profile"
                           action="disable">
                <?php }
                if (isDeactivated($_SESSION['loggedInUser']['u_id']) == 1) { ?>
                    <input type="button" id="activate-back" class="btn btn-default" name="action"
                           value="Activate profile" action="enable">
                <?php } ?>
            </div>

            <h1>Update your info</h1>

            <form enctype="multipart/form-data" method="post" id="userinfo">

                <div class="errors" id="empty-error"></div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="u_email" id="email"
                           value="<?php if (isset($user['u_email'])) print $user['u_email']; ?>"
                           placeholder="Email" required autofocus="true">
                </div>
                <div class="errors" id="email-error"></div>

                <div class="form-group pass">
                    <label for="password1">Password</label>
                    <input type="password" class="form-control" name=" u_password" id="password1"
                           placeholder="Password" required pattern="[a-zA-Z0-9]+">
                </div>
                <div class="errors" id="password-error"></div>

                <div class="form-group">
                    <label for="password2">Re-enter Password</label>
                    <input type="password" class="form-control" id="password2" placeholder="Re-enter Password" required>
                </div>

                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" name=" u_nickname" id="nickname"
                           value="<?php if (isset($user['u_nickname'])) print $user['u_nickname']; ?>"
                           placeholder="Nickname" required>
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" class="form-control" name=" u_birthdate" id="birthdate"
                           value="<?php if (isset($user['u_birthdate'])) print $user['u_birthdate']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="about">About Myself</label>
                    <textarea class="form-control" name=" u_about_myself"
                              id="about"><?php if (isset($user['u_about_myself'])) print $user['u_about_myself']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="file1">File input</label>
                    <input type="file" id="file1" name="file1">
                    <img src="/userpic.php?u_id=<?=$user['u_id']?>&type=public" width="170" height="235" alt="public-picture">
                </div>
                <div class="form-group">
                    <label for="file2">File input</label>
                    <input type="file" id="file2" name="file2">
                    <img src="/userpic.php?u_id=<?=$user['u_id']?>&type=private" width="170" height="235" alt="secret-picture">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="u_id"
                           value="<?php if (isset($user['u_id'])) print $user['u_id']; ?>">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>


        </div>


    </main>


<?php

require_once('templates/footer.php');
?>