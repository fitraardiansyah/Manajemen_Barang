<?php
session_start();
require_once 'core/connection.php';


if (isset($_POST['logout'])) {
    session_destroy();
    header('location:/');
}


if (isset($_POST['delete'])) {
    $del = (int)$_POST['id'];
    $result = $conn->query("DELETE FROM transaksi WHERE id=$del");
    echo "<script>alert('data berhasil dihapus')</script>";
}


if (isset($_POST['tambah'])) {
    $name = strip_tags($_POST['name']);
    $stock = (int)strip_tags($_POST['stock']);
    $harga = (int)strip_tags($_POST['harga']);


    if (empty($name) || empty($stock) || empty($harga)) {
        echo 'form tidak kosong';
    } else {
        $random = date('mdHis', time());
        $insert = $conn->query("INSERT INTO `barang` (`id`, `name`, `unit`, `harga`) VALUES ('$random', '$name', '$stock', '$harga');");
        if ($insert) {
            echo 'berhasil ditambahkan!';
        } else {
            echo 'gagal ditambahkan!';
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
    <header>
        <div class="menu">
            <a href="/">
                <img src="../img/full-m2i8G6K9K9b1Z5b1.png" width="45px" alt="">
            </a>
            <a href="/items">
                <img src="../img/pngegg.png" width="45px" alt="">
            </a>
            <a href="/transaction">
                <img src="../img/payment-icon-5650.png" width="45px" alt="">
            </a>
            <a href="/pelanggan">
                <img src="../img/person.png" width="45px" alt="">
            </a>
            <a href="/suplier">
                <img src="../img/delivery-truck.png" width="45px" alt="">
            </a>
        </div>
        <!-- <form method="post">
            <input type="submit" name="logout" value="Keluar" />
        </form> -->

    </header>


    <div class="wr">
        <div class="header-top">
            <h4>Selamat Datang <?php $user = $_SESSION['login'];
                                echo "$user"; ?>!</h4>
            <form method="post">
                <input type="submit" name="logout" value="Logout" />
            </form>
        </div>
        <div class="wrap">

            <h1>Riwayat Transaksi</h1>
            <div class="list">

                <table>
                    <tr>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>BARANG YANG DIBELI</th>
                        <th>PEMBAYARAN</th>
                        <th>TANGGAL</th>
                        <th>AKSI</th>

                    </tr>
                    <?php
                    $items = $conn->query("SELECT * FROM `transaksi`")->fetch_all();

                    foreach ($items as $item) {
                        $carts = unserialize($item[2]);
                        $append = "";

                        foreach ($carts as $cart) {
                            $append .= "<p> $cart[2] x $cart[3]</p>";
                        }
                        $format = number_format($item[3], 2, ',', '.');
                        echo "
                <tr>
                <td>$item[0]</td>
                <td>$item[1]</td>
                <td>$append</td>
                <td>Rp $format,-</td>
                <td>$item[4]</td>
                <td><form method='post'>
                    <input style='display:none' type='number' name='id' value='$item[0]'>
                    <input  class='btn-delete' type='submit' name='delete' value='hapus' />
                    </form>
                </td>
                </tr>
                ";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>






</body>

</html>