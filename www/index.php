<?php
$title = "Index";
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('templates/header.php');
require_once('lib/businessLogic.php');


is_logged_in();
$relationship = null;


//other user's index page
if (isset($_GET['u_id'])) {
    $user = selectUser($_GET['u_id']);
    $mineProfile = false;
    $relationship = getRelationshipStatus($_SESSION['loggedInUser']['u_id'], $_GET['u_id']);

    $rr = getRelationship($_SESSION['loggedInUser']['u_id'], $_GET['u_id']);

} else {
    //index of a currently logged in user
    $user = selectUser($_SESSION['loggedInUser']['u_id']);
    $mineProfile = true;
}

?>
    <main>
        <div class="container border">
            <div id="profile">
                <!--public data-->
                <div class="public">
                    <img src="/userpic.php?u_id=<?=$user['u_id']?>&type=public" width="170" height="235" alt="public-picture">

                    <div>
                        <p><span class="bold">Nickname:</span> <?= $user['u_nickname']; ?></p>

                        <p><span class="bold">Birthday:</span><?= date('d/m/Y', strtotime($user['u_birthdate'])); ?></p>

                        <p><span class="bold">Email:</span><?= $user['u_email']; ?></p>
                    </div>
                </div>

                <!--secret data. Friends only-->
                <div class="secret">

                    <?php if ($mineProfile || $relationship == FRIENDS) {
                        //calculate days till user birthday
                        $days = calculateDaysTillTheDate($user['u_birthdate']); ?>

                        <img src="/userpic.php?u_id=<?=$user['u_id']?>&type=private" width="170" height="235"
                             alt="secret-picture">
                        <div>
                            <p><span class="bold">About: </span> <?= $user['u_about_myself']; ?></p>

                            <p><span class="bold">Your birthday in <?= $days; ?> days</span></p>
                        </div>



                    <?php } ?>

                </div>
            </div>

            <div class="buttons">
                <?php if (!$mineProfile) {
                    //accept, decline, add-friend and unfriend buttons. Visible depending on relationship status
                    ?>
                    <form method="post">
                        <input type="hidden" name="u_id" id="u_id" value="<?= $user['u_id']; ?>">
                        <input type="hidden" name="r_id" id="r_id" value="<?= $rr['r_id']; ?>">
                        <?php if ($relationship == Relationship::NO_RELATIONSHIP) { ?>

                            <input type="button" id="add-friend" name="action" class="btn btn-default"
                                   value="Add Friend" action="add">
                        <?php }

                        if ($relationship == Relationship::HIS_REQUEST) { ?>
                            <input type="button" id="accept-friendship" class="btn btn-default" name="action"
                                   value="Accept" action="accept">
                            <input type="button" id="decline-friendship" class="btn btn-danger" name="action"
                                   value="Decline" action="decline">
                        <?php }
                        if ($relationship == Relationship::FRIENDS) { ?>
                            <input type="button" id="unfriend" name="action" class="btn btn-danger" action="unfriend"
                                   value="Unfriend">
                        <?php } ?>


                    </form>

                    <?php //request and decline message
                    if ($relationship != Relationship::NO_RELATIONSHIP) {

                        if ($relationship == Relationship::MINE_REQUEST || $relationship == Relationship::HIS_DECLINE) {
                            echo 'Request was sent to user ' . date('d/m/Y', strtotime($rr['r_updated_at']));
                        }
                        if ($relationship == Relationship::MINE_DECLINE) {
                            echo 'Friendship was declined ' . date('d/m/Y', strtotime($rr['r_updated_at']));

                        }
                    }

                } ?>

            </div>

            <div class="posts">
                <?php
                //add new post
                if ($mineProfile) { ?>
                    <form method="post" id="new-post">
                        <textarea name="p_text"
                                  placeholder="A non-writing writer is a monster courting insanity"></textarea>
                        <button type="submit" class="btn btn-default">Post</button>
                    </form>

                    <?php
                    //show currently logged in user posts or other user posts, descending
                    $posts = selectUserPosts($_SESSION['loggedInUser']['u_id']);
                } else {
                    $posts = selectUserPosts($_GET['u_id']);
                }


                foreach ($posts as $post) { ?>
                    <div>
                        <span><?= date('d/m/Y H:i', strtotime($post['p_date'])); ?></span>

                        <p><?= $post['p_text'] ?></p>
                    </div>
                <?php } ?>

            </div>

        </div>
    </main>
<?php

require_once('templates/footer.php');
?>