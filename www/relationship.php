<?php
$title = 'Friendship';
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('templates/header.php');
require_once('lib/businessLogic.php');

is_logged_in();

?>
    <main>
        <div class="container border">
            <div class="row" id="rel-headers">
                <div class="col-xs-6 col-md-4"><h2>REQUEST SENT</h2></div>
                <div class="col-xs-6 col-md-4"><h2>FRIENDS</h2></div>
                <div class="col-xs-6 col-md-4"><h2>DECLINED</h2></div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-4" id="requests">

                    <?php
                    //list of the user's requests sent by other users. each item contains decline(move to the decline list) and accept(move to the friends list) buttons
                    $requests = selectRequests($_SESSION['loggedInUser']['u_id']);

                    foreach ($requests as $request) { ?>
                        <div class="relationship" u_id="<?= $request['u_id']; ?>">
                            <a href="/index.php?u_id=<?= $request['u_id']; ?>">
                                <img src="/userpic.php?u_id=<?=$request['u_id']?>&type=public" width="150" height="170">
                            </a>

                            <p><?= $request['u_nickname']; ?></p>

                            <form method="post">
                                <input type="hidden" name="u_id" value="<?= $request['u_id']; ?>">
                                <input type="button" class="btn btn-default" name="action" value="Accept"
                                       action="accept">
                                <input type="button" class="btn btn-danger" name="action" value="Decline"
                                       action="decline">
                            </form>
                        </div>
                    <?php } ?>


                </div>
                <div class="col-xs-6 col-md-4" id="friends">


                    <?php
                    //list of the user's friends. each item contains unfriend button(delete friendship)
                    $friends = selectActiveUserFriends($_SESSION['loggedInUser']['u_id'], "ASC");

                    foreach ($friends as $friend) { ?>
                        <div class="relationship" u_id="<?= $friend['u_id'] ?>">
                            <a href="/index.php?u_id=<?= $friend['u_id']; ?>">
                                <img src="/userpic.php?u_id=<?=$friend['u_id']?>&type=public" width="150" height="170">
                            </a>

                            <p><?= $friend['u_nickname']; ?></p>

                            <form method="post">
                                <input type="hidden" name="u_id" value="<?= $friend['u_id']; ?>">
                                <input type="button" class="btn btn-danger" name="action" value="Unfriend"
                                       action="unfriend">
                            </form>

                        </div>
                    <?php } ?>


                </div>
                <div class="col-xs-6 col-md-4" id="declines">


                    <?php
                    //list of the users that the user declined. each item contains regret button(move to the friends list)
                    $declines = selectDeclines($_SESSION['loggedInUser']['u_id']);

                    foreach ($declines as $decline) { ?>
                        <div class="relationship" u_id="<?= $decline['u_id'] ?>">
                            <a href="/index.php?u_id=<?= $decline['u_id']; ?>">
                                <img src="/userpic.php?u_id=<?=$decline['u_id']?>&type=public" width="150" height="170">
                            </a>

                            <p><?= $decline['u_nickname']; ?></p>

                            <form method="post">
                                <input type="hidden" name="u_id" value="<?= $decline['u_id']; ?>">
                                <input type="button" class="btn btn-default" name="action" value="Regret button"
                                       action="regret">
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>


<?php

require_once('templates/footer.php');
?>