<?php
  require 'config.php';
  session_start();
  if (isset($_GET['shop'])) {
    $shop = $_GET['shop'];
    $_SESSION['shop'] = $shop;
    $scopes = "read_orders,write_products";
    $redirect_uri = $APP_URL."/generate_token.php";
    $install_url = "https://". $shop."/admin/oauth/authorize?client_id=".$API_KEY."&scope=".$scopes ."&secret=" . $SECRET_KEY . "&redirect_uri=" . urlencode($redirect_uri);
    header("Location: " . $install_url);
    die();
  }
?>