<?php
session_start();
// Define your location project directory in htdocs (EX THE FULL PATH: D:\xampp\htdocs\x-kang\simple-routing-with-php

// For get URL PATH
$request = explode("?", $_SERVER['REQUEST_URI']);

switch ($request[0]) {
    case '/login':
        require "views/login.php";
        break;
    case '/register':
        require "views/register.php";
        break;


        //login required
    case '/':
        isset($_SESSION['login']) ?
            require "views/dashboard.php" : require "views/login.php";
        break;
    case '/items':
        isset($_SESSION['login']) ?
            require "views/items.php" : require "views/login.php";
        break;
    case '/pelanggan':
        isset($_SESSION['login']) ?
            require "views/pelanggan.php" : require "views/login.php";
        break;
    case '/suplier':
        isset($_SESSION['login']) ?
            require "views/suplier.php" : require "views/login.php";
        break;
    case '/transaction':
        isset($_SESSION['login']) ?
            require "views/transaction.php" : require "views/login.php";
        break;
    case '/edit':
        isset($_SESSION['login']) ?
            require "views/edit_barang.php" : require "views/login.php";
        break;
    case '/editp':
        isset($_SESSION['login']) ?
            require "views/edit_pelanggan.php" : require "views/login.php";
        break;
    case '/edits':
        isset($_SESSION['login']) ?
            require "views/edit_suplier.php" : require "views/login.php";
        break;
    default:
        http_response_code(404);
        echo "404";
        break;
}
