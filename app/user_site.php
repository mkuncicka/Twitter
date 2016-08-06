<?php

require_once '../src/Tweet.php';
require_once '../src/User.php';
require_once 'dbConnection.php';
redirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['usersList'])) {
    redirect('users_list.php');
}
?>

<html>
<head>
    <title>Strona użytkownika</title>
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class = "menu">

        <p>Zalogowano jako: <a href="user_site.php"><?php echo $loggedUser->getEmail();?></a></p>
        <form method="post">
            <ul>
                <li><button type="submit" name="logout" class="btn">Wyloguj</button></li>
                <li><button type="submit" name="usersList" class="btn">Lista użytkowników</button></li>
            </ul>
        </form>

    </div>

    <h1>
        To jest strona użytkownika: <a href="user_site.php"><?php echo $loggedUser->getEmail();?></a>.
    </h1>
<div>
    <p>Informacje:</p>
        <p><?php echo $loggedUser->getDescription();?></p>
        <form action="edit_user.php">
        <button class="btn" type="submit">Edytuj informacje</button>
        </form>
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
<div>
    <form action="messages_site.php">
        <button type="submit" class="btn" name="messages">Zobacz wiadomości</button>
    </form>
</div>
</div>
</body>
</html>
