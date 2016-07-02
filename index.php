<?php

require_once 'src/functions.php';
require_once 'src/Tweet.php';

$conn = connectToDataBase();
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' and (isset($_POST['logout']))) {
    unset($_SESSION['user_id']);
}
redirectIfNotLoggedIn();
$user_id = ($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' and ($_POST['new_tweet'])) {
    $text = ($_POST['new_tweet']);
    $tweet = new Tweet($user_id, $text);
    $tweet->save($conn);
}
?>

<html>
<head>
    <title>Strona główna</title>
</head>
<body>
<div>
    <form method="post">
    <button type="submit" name="logout">Wyloguj</button>
    </form>
</div>
<div class="container">
    <p>
        <?php echo $_SESSION['user_id'] . " - ";?>Witaj na stronie głównej.
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
    <h3>Wszystkie Tweety tomka:</h3>
    <?php
    $allTweets = Tweet::getUserTweets($conn, $user_id);
        foreach ($allTweets as $tweet) {
            echo "<p>" . $tweet->getText() . "</p>";
        }

    ?>
</div>

</body>
</html>
