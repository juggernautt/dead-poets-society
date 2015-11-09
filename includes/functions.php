<?php


function prr($var)
{
    print "<pre>";
    print_r($var);
    print "</pre>";
}


function redirect($location)
{
    header('Location:' . $location);
    die();
}




function is_logged_in()
{
    if (!isset($_SESSION['loggedInUser'])) {
        redirect('/login.php');
    }
}



function move_files($file)
{
    $name = "";
    if ($file['type'] == 'image/jpeg') {
        $tmp_name = $file["tmp_name"];
        $name = uniqid() . $file["name"];
        $destination = '../user_uploads/';
        move_uploaded_file($tmp_name, $destination . $name);
    }
    return $name;
}


function getUserPic($pictureSrc) {
    $src = ($pictureSrc != "") ? $pictureSrc : "images/anonymous.jpg";
    return $src;
}

function calculateDaysTillTheDate($date)
{
    $dateArray = explode("-", $date);
    $currentYear = date('Y', time());
    $tillDate = mktime(0, 0, 0, $dateArray[1], $dateArray[2], $currentYear, 0);
    $today = time();
    $diffInDays = floor(($tillDate - $today) / SECONDS_IN_DAY);
    if ($diffInDays < 0) {
        $diffInDays = 365 + $diffInDays;
    }
    return $diffInDays;
}

function getRandomQuote()
{
    $quotes = array();
    $quotes[] = "I write it because there is some lie that I want to expose, some fact to which I want to draw attention, and my initial concern is to get a hearing.";
    $quotes[] = "Every secret of a writer’s soul, every experience of his life, every quality of his mind, is written large in his works.";
    $quotes[] = "To defend what you’ve written is a sign that you are alive.";
    $quotes[] = "Everywhere I go I find a poet has been there before me.";
    $quotes[] = "I don’t need an alarm clock. My ideas wake me.";
    $quotes[] = "Let the world burn through you. Throw the prism light, white hot, on paper";
    $quotes[] = "It’s none of their business that you have to learn to write. Let them think you were born that way.";
    $quotes[] = "Literature is strewn with the wreckage of men who have minded beyond reason the opinions of others.";
    $quotes[] = "The difference between the almost right word and the right word is … the difference between the lightning bug and the lightning.";
    $quotes[] = "I think all writing is a disease. You can’t stop it.";


    $result = array_rand($quotes, 1);
    return $quotes[$result];

}

