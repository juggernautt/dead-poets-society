<?php
$title = 'Friends';
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('templates/header.php');
require_once('lib/businessLogic.php');


is_logged_in();

//show all users
if ($_GET['show'] == 'all') {
    $users = selectAllActiveUsers($_SESSION['loggedInUser']['u_id'], "ASC");
} else {
    //show only user friends
    $users = selectActiveUserFriends($_SESSION['loggedInUser']['u_id'], "ASC");
}

?>

    <script src="js/filter-bar.js"></script>
    <main>
        <div class="container border">
            <div class="center">
                <form>
                    <!--filter bar and sort results ascending/descending-->
                    <input name="filter" class="find-friends" type="text" placeholder="Search friends"/>

                    <p>Order by
                        <span><label>ASC: <input name="order_by" type="radio" value="asc" id="asc"></label></span>
                        <span><label>DESC: <input name="order_by" type="radio" value="desc" id="desc"></label></span>
                    </p>
                </form>


                <?php if ($users) {
                    foreach ($users as $user) { //list of items as users ?>

                        <div class="user">
                            <a href="/index.php?u_id=<?= $user['u_id']; ?>">
                                <img src="/userpic.php?u_id=<?=$user['u_id']?>&type=public" width="150" height="167">
                            </a>

                            <p class="nickname"><?= $user['u_nickname']; ?></p>

                            <p><?= date('d/m/Y', strtotime($user['u_register_date'])); ?></p>

                            <p><?= $user['u_email']; ?></p>
                        </div>


                    <?php }

                } ?>
            </div>
            <!--message shown if there are no results-->
            <div id="no-found">
                Nobody found
            </div>

        </div>
    </main>

<?php

require_once('templates/footer.php');
?>