<?php
  $access_token = $_POST['access_token'];
  $shop = $_POST['shop'];
  $productId = $_POST['productId'] ; 
  $variantId = $_POST['variantId'] ; 
  $marketId = $_POST['marketId'] ; 
  $isCheckedAll = $_POST['isCheckedAll'] ; 
  $metafield_id = $_POST['metafield_id'] ; 
  $marketLink = $_POST['marketLink'] ; 

  $headers = array(
    'X-Shopify-Access-Token: '.$access_token,
    'Content-Type: application/json'
  );
  if($isCheckedAll == 'false' && $variantId !== null &&  $variantId != '')
    $endpoint = "/admin/api/2023-01/variants/".$variantId."/metafields.json";
  else
    $endpoint = "/admin/api/2023-01/products/".$productId."/metafields.json";
  
  $metafieldData = array(
    'namespace' => $marketId,
    'key' => ($isCheckedAll == 'false' && $variantId !== null &&  $variantId != '') ? $variantId : 'all',
    'value' => $marketLink,
    'type' => 'single_line_text_field'
  );
  $ch = curl_init();

  if($metafield_id === null || $metafield_id == ''){
    curl_setopt($ch, CURLOPT_URL, "https://".$shop.$endpoint);
    curl_setopt($ch, CURLOPT_POST, true);
  }
  else{
    $endpoint = "/admin/api/2023-01/metafields/".$metafield_id.".json";
    curl_setopt($ch, CURLOPT_URL, "https://".$shop.$endpoint);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
  }

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('metafield' => $metafieldData)));
  
  $response = curl_exec($ch);
  curl_close($ch);
  print_r($response);

?>
