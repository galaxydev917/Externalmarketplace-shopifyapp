<?php

//echo "hello";
//print_r($_POST);
$prdctid = $_POST['prdct_id'];

 $radioslct_value = $_POST['selected'];
 $variable_val = $_POST['variable_val'];
$getoptiondata = explode(",",$variable_val);
$variant_name = $getoptiondata[0];
$variant_ids = $getoptiondata[1];



	

$curl = curl_init();

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
	 else
	 {
		echo "Empty"; break;
		
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
	 else
	 {
		 echo "Empty"; break;
		
	 }
	
	
	 
	 
	 
 }
	
} 

