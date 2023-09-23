<?php
function load_login_db(string $name)
{
    require 'connection.php';
    $customer = $conn->query("SELECT name,pass FROM `operator` WHERE name='$name'")->fetch_assoc();
    return $customer;
}


function load_item_all()
{
    require 'connection.php';
    $db = $conn->query("SELECT * FROM `barang`")->fetch_all();
    return $db;
}

function itemAdd(int $id, string $name, int $unit, int $harga)
{
    require 'connection.php';
    $db = $conn->query("INSERT INTO `barang` (`id`, `name`, `unit`, `harga`) VALUES ('$id', '$name', '$unit', '$harga');");
    return $db;
}

function itemUpdate(int $id, string $name, int $unit, int $harga)
{
    require 'connection.php';
    $db = $conn->query("UPDATE `barang` SET `name` = '$name', `unit` = '$unit', `harga` = '$harga' WHERE `barang`.`id` = $id;");
    return $db;
}

function itemDelete(int $id)
{
    require 'connection.php';
    $db = $conn->query("DELETE FROM barang WHERE id=$id");
    return $db;
}

function load_pelanggan_all()
{
    require 'connection.php';
    $db = $conn->query("SELECT * FROM `pelanggan`")->fetch_all();
    return $db;
}

function pelangganAdd(int $id, string $name, string $alamat, int $telpon)
{
    require 'connection.php';
    $db = $conn->query("INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telpon`) VALUES ('$id', '$name', '$alamat', '$telpon');");
    return $db;
}

function pelangganUpdate(int $id, string $name, string $alamat, int $telpon)
{
    require 'connection.php';
    $db = $conn->query("UPDATE `pelanggan` SET `nama` = '$name', `alamat` = '$alamat', `telpon` = '$telpon' WHERE `pelanggan`.`id` = $id;");
    return $db;
}

function pelangganDelete(int $id)
{
    require 'connection.php';
    $db = $conn->query("DELETE FROM pelanggan WHERE id=$id");
    return $db;
}

function load_suplier_all()
{
    require 'connection.php';
    $db = $conn->query("SELECT * FROM `suplier`")->fetch_all();
    return $db;
}

function suplierAdd(int $id, string $name, string $alamat, int $telpon)
{
    require 'connection.php';
    $db = $conn->query("INSERT INTO `suplier` (`id`, `nama`, `alamat`, `telpon`) VALUES ('$id', '$name', '$alamat', '$telpon');");
    return $db;
}

function suplierUpdate(int $id, string $name, string $alamat, int $telpon)
{
    require 'connection.php';
    $db = $conn->query("UPDATE `suplier` SET `nama` = '$name', `alamat` = '$alamat', `telpon` = '$telpon' WHERE `suplier`.`id` = $id;");
    return $db;
}

function suplierDelete(int $id)
{
    require 'connection.php';
    $db = $conn->query("DELETE FROM suplier WHERE id=$id");
    return $db;
}




function convertCashFormat(int $text)
{
    return number_format($text, 2, ',', '.');
}
