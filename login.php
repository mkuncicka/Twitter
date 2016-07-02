<?php
require_once 'src/functions.php';
require_once 'src/User.php';

$conn = connectToDataBase();
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['email']) and isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $loggedUser = User::logIn($conn, $email, $password);
        if ($loggedUser) {
            session_start();
            $_SESSION['user_id'] = $loggedUser->getId();
            redirect('index.php');
        } else {
            echo "Błędny e-mail lub hasło.<br>";
        }
    } else {
        echo "Błędny e-mail lub hasło.<br>";
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
            <input type="email" name="email" placeholder="Wpisz e-mail">
        </p>
        <p>
        <label for="password">hasło</label>
            <input type="password" name="password" placeholder="Wpisz hasło">
        </p>
        <p>
            <button type="submit" name="login">Zaloguj</button>
        </p>
        <p>
            <a href="registration.php">Nie masz konta? Zarejestruj się!</a>
        </p>
    </form>
</body>
</html>

