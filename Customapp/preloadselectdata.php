<?php 




  $marktplslctval = $_POST['marktplslctval'];
$variableselct = $_POST['variableselct'];
$getoptiondata = explode(",",$variableselct);
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
  /* echo "<pre>";
print_r($newresponse);
die(); */ 

foreach($newresponse->metafields as $metafields){
	
	
	  $meta_namespace = $metafields->namespace;
	  $meta_key = $metafields->key;
	  $meta_id = $metafields->id;
	 if($meta_key == $marktplslctval && $meta_namespace == $variant_name)
	 {
		echo $meta_val = $metafields->value;
		
		
	 }
	
	
}


?>