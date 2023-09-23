<?php
session_start();
require_once 'core/connection.php';
require 'core/db-hook.php';


if (isset($_POST['logout'])) {
    session_destroy();
    header('location:/');
}

if (isset($_POST['delete'])) {
    $del = (int)$_POST['id'];
    if (pelangganDelete($del)) {
        echo "<script>alert('data berhasil dihapus')</script>";
    }
}

if (isset($_POST['tambah'])) {
    $name = strip_tags($_POST['name']);
    $stock = strip_tags($_POST['stock']);
    $harga = (int)strip_tags($_POST['harga']);


    if (empty($name) || empty($stock) || empty($harga)) {
        echo "<script>alert('pastikan form tidak kosong')</script>";
    } else {
        $random = date('mdHis', time());
        if (pelangganAdd($random, $name, $stock, $harga)) {
            echo "$<script>alert('data berhasil ditambah')</script>";
        } else {
            echo "<script>alert('data gagal ditambah')</script>";
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

        <main>
            <div class="wrap">
                <h1>Data Pelanggan</h1>
                <div class="list">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Aksi</th>

                        </tr>
                        <?php
                        $items = load_pelanggan_all();
                        foreach ($items as $item) {
                            echo "
                        <tr>
                        <td>$item[0]</td>
                        <td>$item[1]</td>
                        <td>$item[2]</td>
                        <td>$item[3]</td>
                        <td><form method='post'>
                            <input style='display:none' type='number' name='id' value='$item[0]'>
                       
                            <a  class='btn-edit' href='/editp?id=$item[0]'>Edit</a>
                            <input  class='btn-delete' type='submit' name='delete' value='Hapus' />
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
                <form method="post">
                    <h2>Tambah Pelanggan</h2>
                    <input class="field" type="text" name="name" placeholder="Nama_Lengkap">
                    <br />
                    <input class="field" type="text" name="stock" placeholder="Alamat">
                    <br />
                    <input class="field" type="number" name="harga" placeholder="Telpon">
                    <input class='btn-login' type="submit" name="tambah" value="Tambah" />
                </form>
            </div>
    </div>




    </main>

</body>

</html>