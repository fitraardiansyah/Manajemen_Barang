<?php
session_start();
require_once 'core/connection.php';

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:/');
}



if (isset($_POST['delete'])) {
    $del = (int)$_POST['id'];
    $del2 = (int)$_POST['id2'];
    $get = $conn->query("SELECT * FROM `barang` WHERE id='$del2'")->fetch_assoc();
    $i = $conn->query("SELECT unit FROM `tmp` WHERE id='$del'")->fetch_assoc();
    $return = $get['unit'] + $i['unit'];
    $insert = $conn->query("UPDATE `barang` SET `unit` = '$return' WHERE `barang`.`id` = $del2;");
    $result = $conn->query("DELETE FROM tmp WHERE id=$del");
}

if (isset($_POST['tambah'])) {
    $name = strip_tags($_POST['item']);
    $stock = (int)strip_tags($_POST['stock']);

    $get = $conn->query("SELECT * FROM `barang` WHERE name='$name'")->fetch_assoc();

    if (empty($name) || empty($stock)) {
        echo "<script>alert('pastikan form tidak kosong')</script>";
    } else if (!$get || $get['unit'] < $stock) {
        echo "<script>alert('barang tidak ditemukan atau stock tidak mencukupi')</script>";
    } else {
        $i = (int)$get['id'];
        $temp_id = $i;
        $n = $get['name'];
        $t = (int)$get['harga'] * $stock;
        $random = date('mdHis', time());
        $ambil = $get['unit'] - $stock;
        $insert = $conn->query("UPDATE `barang` SET `unit` = '$ambil' WHERE `barang`.`id` = $i;");
        $conn->query("INSERT INTO `tmp` (`id`, `id_item`, `name`, `unit`, `total`) VALUES ('$random', '$i', '$n', '$stock', '$t');");
    }
}

if (isset($_POST['checkout'])) {
    $n = $_POST['name'];
    $p =  $_POST['payment'];
    $i = $conn->query("SELECT * FROM `tmp`")->fetch_all();
    $e =  serialize($i);
    $timestamp = date('Y-m-d H', time());
    $random = date('mdHis', time());

    $total = 0;
    foreach ($conn->query("SELECT total FROM `tmp`")->fetch_all() as $count) {
        $total = $total + (int)$count[0];
    }

    if (empty($n) || empty($p) || sizeof($i) <= 0) {
        echo "<script>alert('pastikan form tidak kosong')</script>";
    } else if ($p >= $total) {

        $conn->query("INSERT INTO `transaksi` (`id`, `name`, `cart`, `cash`, `time`) VALUES ('$random', '$n', '$e', '$p', '$timestamp');");
        $conn->query("DELETE FROM tmp;");
    } else {
        echo "<script>alert('Uang Tidak Cukup untuk membayar!')</script>";
    }
    // header("Location: core/login.php");
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



        <main>
            <div class="wrap">
                <h1>Data Barang</h1>
                <div class="list">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>NAMA BARANG</th>
                            <th>JUMLAH</th>
                            <th>HARGA</th>
                            <th>Aksi</th>

                        </tr>
                        <?php
                        $carts = $conn->query("SELECT * FROM `tmp`")->fetch_all();
                        foreach ($carts as $item) {
                            $format = number_format($item[4], 2, ',', '.');
                            echo "
                    <tr>
                    <td>$item[0]</td>
                    <td>$item[2]</td>
                    <td>$item[3]</td>
                    <td>Rp $format,-</td>
                    <td><form method='post'>
                        <input style='display:none' type='number' name='id' value='$item[0]'>
                        <input style='display:none' type='number' name='id2' value='$item[1]'>
                        <input class='btn-delete' type='submit' name='delete' value='hapus' />
                        </form>
                    </td>
                    </tr>
                    ";
                        }
                        ?>
                    </table>
                </div>
            </div>



            <div class="login2">
                <div class="tagihan">
                    <h1>Tagihan :
                        <?php
                        $total = 0;
                        foreach ($conn->query("SELECT total FROM `tmp`")->fetch_all() as $count) {
                            $total = $total + (int)$count[0];
                        }
                        $format = number_format($total, 2, ',', '.');
                        echo "Rp $format,-";
                        ?>
                    </h1>
                </div>

                <form method="post">
                    <h2>Barang yg dijual</h2>

                    <input class="field" type="text" name="item" placeholder="Nama Barang">
                    <br />

                    <input class="field" type="number" name="stock" placeholder="Jumlah Barang Yang Dibeli">
                    <br />
                    <input class="btn-login" type="submit" name="tambah" value="Tambah" />
                    <h2>Transaksi</h2>

                    <input class="field" type="text" name="name" placeholder="Nama Lengkap">
                    <br />

                    <input class="field" type="number" name="payment" placeholder="Pembayaran">

                    <input class="btn-login" type="submit" name="checkout" value="Checkout" />
                </form>
        </main>

    </div>


    </div>



</body>

</html>