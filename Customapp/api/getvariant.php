<?php
  $product_id = $_POST['product_id'] ; 
  $endpoint = "/admin/api/2023-01/products/".$product_id."/variants.json";
  $access_token = $_POST['access_token'];
  $shop = $_POST['shop'];
  $headers = array(
    'X-Shopify-Access-Token: '.$access_token,
    'Content-Type: application/json'
  );
  // echo "https://$shop$endpoint";
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://$shop$endpoint");
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);
  $variantList = json_encode($response, true);
  print_r($variantList);
?>
