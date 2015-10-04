<?php
$title = 'Login';
$hideMenu = true;
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('templates/header.php');
require_once('lib/businessLogic.php');


if ($_POST) {
    $user = array();
    $user['u_email'] = $_POST['u_email'];
    $user['u_password'] = $_POST['u_password'];
    $userArr = selectEmailAndPasswordLogInProcess($user['u_email'], $user['u_password']);

    //invalid email or password
    if (!$userArr) {
        redirect('/login.php?error=true');
    } else {
        $_SESSION['loggedInUser'] = $userArr;
        redirect('/index.php');
    }


}

//while logged in, can't get to login page
if (isset($_SESSION['loggedInUser'])) {
    redirect('/index.php');
}
?>

    <main>
        <script type="text/javascript" src="js/login-as.js"></script>
        <div class="login">
            <h1>Sign In</h1>

            <form class="form-horizontal" method="post">
                <?php if (isset($_GET['error'])) { ?>
                    <!--Error message if user failed to login-->
                    <div class="login-error">Invalid email or password</div>
                <?php } ?>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="u_email" placeholder="Email"
                               value="<?php if (isset($user['u_email'])) print $user['u_email']; ?>" autofocus="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="u_password"
                               placeholder="Password"
                               value="<?php if (isset($user['u_password'])) print $user['u_password']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
                <a id="login-link" href="/registration.php">Please sign up here</a>
            </form>

            <div id="login-as">
                <button class="btn btn-primary" id="as-hemingway">Test Login as Hemingway</button>
                <button class="btn btn-primary" id="as-kafka">Test Login as Kafka</button>
            </div>
        </div>


    </main>

<?php

require_once('templates/footer.php');
?>