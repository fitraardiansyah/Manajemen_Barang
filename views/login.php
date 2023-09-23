<?php
session_start();
require_once 'core/connection.php';
require_once 'core/db-hook.php';


if (isset($_POST['submit'])) {
    $name = strip_tags($_POST['name']);
    $pass = strip_tags($_POST['password']);

    if (empty($name) || empty($pass)) {
        echo 'form tidak] kosong';
    } else {
        $customer = load_login_db($name);
        if (password_verify($pass, $customer['pass'])) {
            $_SESSION['login'] = $customer['name'];
            header('location:/');
        } else {
            echo 'Login gagal!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="login">
        <form method="post">
            <h2>Login</h2>
            <input class="field" type="text" name="name" placeholder="Nama Lengkap">
            <input class="field" type="password" name="password" placeholder="Password">
            <h4>Belum menjadi operator?<a href="register"> daftar</a></h4>
            <input class="btn-login" type="submit" name="submit" value="Masuk">
        </form>
    </div>

</body>

</html>