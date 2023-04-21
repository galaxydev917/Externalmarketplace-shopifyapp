<?php

//echo "hello";
//print_r($_POST);
$prdctid = $_POST['prdct_idd'];

 $radioslct_value = $_POST['radioval'];
$variable_val = $_POST['variable_sval'];
$getoptiondata = explode(",",$variable_val);
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
	//echo "products";
	
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
	//print_r($newresponses);die();
	//echo $namesapce =newresponses->metafields[0]->namespace;
	
	if($radioslct_value == 'imgupldd')
 {
	 //echo"image";
	foreach($newresponses->metafields as $prdctmetafield){
	
	
	  $prdctnamespace = $prdctmetafield->namespace;
	   $prdctmeta_key = $prdctmetafield->key;
	   $prdctmeta_value = $prdctmetafield->value;
	  //$prdctmeta_id = $prdctmetafield->id;
	 if($prdctmeta_key == 'Image')
	 {
		
		echo "image".",". $meta_name = $prdctnamespace.",".$prdctmeta_value.",".$prdctid;
		//echo $meta_val = $metafields->value;
		
		
	 }
	
	
}
 }
 else if ($radioslct_value == 'text'){
	//echo "text";
	foreach($newresponses->metafields as $metafieldprdct){
		 
		 
	  $meta_namespaceeprdct = $metafieldprdct->namespace;
	 
	   $meta_keyyprdct = $metafieldprdct->key;
	 $meta_valueprdct = $metafieldprdct->value;
	  $meta_iddprdct = $metafieldprdct->id;
	 if($meta_keyyprdct == 'Text')
	 {
		
		echo "text".",".$meta_val =$meta_namespaceeprdct.",".$meta_valueprdct ;
		//echo $meta_vall = $metafieldss->value;
		
		
	 }
	
	 
	 
	 
 }
	
}
}
else{
	//echo "variants";
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
// print_r($newresponse);
 
if($radioslct_value == 'imgupldd')
 {
	// echo "img";
	 foreach($newresponse->metafields as $metafields){
		 
		 
	 $meta_namespace = $metafields->namespace;
	 
	   $meta_key = $metafields->key;
	  $meta_valuee = $metafields->value;
	  $meta_id = $metafields->id;
	 if($meta_key == 'Image')
	 {
		
		echo "image".",". $meta_name = $meta_namespace.",".$meta_valuee.",".$variant_ids;
		//echo $meta_val = $metafields->value;
		
		
	 }
	
	 
	 
	 
 }
 }
else if ($radioslct_value == 'text'){
	//echo "text";
	foreach($newresponse->metafields as $metafieldss){
		 
		 
	 $meta_namespacee = $metafieldss->namespace;
	 
	   $meta_keyy = $metafieldss->key;
	$meta_value = $metafieldss->value;
	  $meta_idd = $metafieldss->id;
	 if($meta_keyy == 'Text')
	 {
		
		echo "text".",".$meta_val =$meta_namespacee.",".$meta_value ;
		//echo $meta_vall = $metafieldss->value;
		
		
	 }
	
	 
	 
	 
 }
	
} 
	
} 
  