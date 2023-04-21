<?php 

$markt_val = $_POST['marktselect'];
$prdctid = $_POST['prctid'];
$var_val = $_POST['varselect'];
$getoptiondata = explode(",",$var_val);
$variant_name = $getoptiondata[0];
$variant_ids = $getoptiondata[1];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prdctid.'/variants.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$responsesprdct = curl_exec($curl);
$newresponsesprdct = json_decode($responsesprdct);

//print_r($newresponsesprdct);

if($newresponsesprdct->variants[0]->title == 'Default Title'){
	//echo "hello";
	curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prdctid.'/metafields.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$responses = curl_exec($curl);
$newresponses = json_decode($responses);
	//print_r($newresponses);
	//echo $namesapce =newresponses->metafields[0]->namespace;
	foreach($newresponses->metafields as $metafield){
	
	
	  $namespace = $metafield->namespace;
	  //$meta_key = $metafields->key;
	  //$meta_id = $metafields->id;
	 if($namespace == $markt_val)
	 {
		echo $meta_vall = $metafield->value;
		
		
	 }
	
	
}
}
else{
	//echo"hi";



curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/variants/'.$variant_ids.'/metafields.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
$newresponse = json_decode($response);

foreach($newresponse->metafields as $metafields){
	
	
	  $meta_namespace = $metafields->namespace;
	  $meta_key = $metafields->key;
	  $meta_id = $metafields->id;
	 if($meta_key == $markt_val && $meta_namespace == $variant_name)
	 {
		echo $meta_val = $metafields->value;
		
		
	 }
	
	
}
}


curl_close($curl);









?>