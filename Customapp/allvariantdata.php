<?php
//print_r($_POST);
$prdctid = $_POST['product_id'] ; 
$curll = curl_init();

curl_setopt_array($curll, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prdctid.'/variants.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$responses = curl_exec($curll);
$newresponses = json_decode($responses);
// print_r($newresponses);die;

foreach($newresponses->variants as $variant){
	 $id = $variant->id;

 $title = $variant->title;
}
 
?>