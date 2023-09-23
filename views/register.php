<?php
require_once './core/connection.php';

if (isset($_POST['submit'])) {
    $name = strip_tags($_POST['name']);
    $pass = strip_tags($_POST['password']);

    if (empty($name) || empty($pass)) {
        echo 'form tidak kosong';
    } else {
        $random = date('mdHis', time());
        $crypt = password_hash($pass, PASSWORD_BCRYPT);
        $insert = $conn->query("INSERT INTO `operator` (`id`, `name`, `pass`) VALUES ('$random', '$name', '$crypt');");
        if ($insert) {
            echo 'Pendaftaran berhasil!';
        } else {
            echo 'Pendaftaran gagal!';
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
            <h2>Registrasi</h2>
            <input class="field" type="text" name="name" placeholder="Nama Lengkap">
            <input class="field" type="password" name="password" placeholder="Password">
            <h4>Sudah menjadi operator?<a href="login"> masuk</a></h4>
            <input class="btn-login" type="submit" name="submit" value="Daftar">
        </form>
    </div>


    <?php
    ?>
</body>

</html>