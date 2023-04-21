<?php
  $productId = $_POST['productId'] ; 
  $variantId = $_POST['variantId'] ; 
  $marketId = $_POST['marketId'] ; 
  if($variantId === null || $variantId == ''){
    $endpoint = "/admin/api/2023-01/products/".$productId."/metafields.json?namespace=".$marketId."&key=all";
  }
  else
    $endpoint = "/admin/api/2023-01/variants/".$variantId."/metafields.json?namespace=".$marketId."&key=".$variantId;

  $access_token = $_POST['access_token'];
  $shop = $_POST['shop'];
  $headers = array(
    'X-Shopify-Access-Token: '.$access_token,
    'Content-Type: application/json'
  );
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://$shop$endpoint");
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);
  $metafields = json_encode($response, true);
  print_r($metafields);
?>
