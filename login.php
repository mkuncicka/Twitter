<?php
require_once 'src/functions.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['mail']) and isset($_POST['password'])) {
        
    }
}
?>

<html>
<head>
    <title>Strona logowania</title>
</head>
<body>
    <form method="post">
        <p>
        <label for="mail">e-mail</label>
            <input type="email" name="mail" placeholder="Wpisz e-mail">
        </p>
        <p>
        <label for="password">hasło</label>
            <input type="password" name="password" placeholder="Wpisz hasło">
        </p>
        <p>
            <button type="submit" name="login">Zaloguj</button>
        </p>
    </form>
</body>
</html>

