<?php

require_once 'src/functions.php';
require_once 'src/Tweet.php';
require_once 'src/User.php';

$conn = connectToDataBase();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}
redirectIfNotLoggedIn();
$user_id = ($_SESSION['user_id']);
$loggedUser = User::getUser($conn, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' and ($_POST['new_tweet'])) {
    $text = ($_POST['new_tweet']);
    $date = date('Y-m-d h:i:s');
    $tweet = new Tweet($user_id, $text, $date);
    $tweet->save($conn);
    redirect('index.php');
}


?>

<html>
<head>
    <title>Strona główna</title>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div>
    <p>
        Zalogowano jako: <a href="user_site.php"><?php echo $loggedUser->getEmail();?></a>
    <form method="post">
        <button type="submit" name="logout">Wyloguj</button>
    </form>
    </p>
</div>
<div class="container">

    <p>
        Witaj na stronie głównej.
    </p>
</div>
<div>
    <p>
        <form method="post">
            <label>Dodaj tweeta:<br>
                <textarea name="new_tweet"></textarea>
            </label>
    <p>
        <button type="submit" name="add_tweet">Dodaj</button>
    </p>
    </form>

    </p>
</div>
<div>
    <h3>Wszystkie Tweety <?php echo $loggedUser->getEmail();?>:</h3>
    <?php
    $allTweets = $loggedUser->getAllTweets($conn);
    if ($allTweets) {
        foreach ($allTweets as $tweet) {
            echo "<a href='tweet_site.php?tweet_id={$tweet->getId()}'><p>{$tweet->getText()}</p></a>";
        }
    } else {
        echo "Nie masz jeszcze żadnych tweetów";
    }

    ?>
</div>

</body>
</html>




