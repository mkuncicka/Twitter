<?php
require_once 'src/functions.php';
$conn = connectToDataBase();
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['email']) and isset($_POST['password'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $description = $conn->real_escape_string($_POST['description']);
        $isActive = true;
        $query = "INSERT INTO `users` (`email`, `hashed_password`, `description`, `is_active`)"
            . "VALUES ('$email', '$password', '$description', '$isActive')";
        $conn->query($query);
        redirect('login.php');
    }
}
?>

<html>
<head>
    <title>Formularz rejestracji</title>
</head>
<body>
<form method="post">
    <p>
        <label for="mail">Podaj email</label>
        <input type="email" name="email" placeholder="Wpisz e-mail">
    </p>
    <p>
        <label for="password">Podaj hasło</label>
        <input type="password" name="password" placeholder="Wpisz hasło">
    </p>
    <p>
        <label for="description">Podaj informacje o sobie</label>
        <input type="text" name="description" placeholder="Dodaj opis swojej osoby">
    </p>
    <p>
        <button type="submit" name="register">Zarejestruj</button>
    </p>
</form>
</body>
</html>
