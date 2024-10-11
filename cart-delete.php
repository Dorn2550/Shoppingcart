<?php
session_start();
include 'config2.php';

if(!empty($_GET['id'])) {
    unset($_SESSION['cart'][$_GET['id']]);
    $_SESSION['message'] = 'Cart delete success';
}

header('location: ' . $base_url . '/cart.php');