<?php 
//echo "hello";

//print_r($_POST);

$radio_val = $_POST['radselected'];
$varblslct_val = $_POST['variable_slctval'];
$getoptiondata = explode(",",$varblslct_val);
$variant_name = $getoptiondata[0];
 $variant_ids = $getoptiondata[1];
$prodct_id = $_POST['prodct_ids'];
$image_val = $_POST['imagesval'];
 $imagelink_val = $_POST['image_linkval'];
 $title_val = $_POST['title_val'];


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prodct_id.'/variants.json',
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
	echo "products";
	curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prodct_id.'/metafields.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$prdctresponse = curl_exec($curl);
$prdctnewresponse = json_decode($prdctresponse);

//print_r($prdctnewresponse);

foreach($prdctnewresponse->metafields as $prdctmetafields){
	
	
	echo $prdctmeta_namespace = $prdctmetafields->namespace;
	   $prdctmeta_key = $prdctmetafields->key;
	$prdctmeta_id = $prdctmetafields->id;
	 if($radio_val == 'imgupldd'){
		// echo "image";
	  if($prdctmeta_namespace == $image_val)
	 {
	$prdctshopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$prdctpostClonedID_inOriginall = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/'.$prdctmeta_id.'"}}}';

             $prdctresponseClonedID_inOriginall = post_to_webpage($prdctshopifyAPIUrll . "/admin/api/2023-01/graphql.json", $prdctpostClonedID_inOriginall);

             $prdctdecode_ClonedID_inOriginall = json_decode($prdctresponseClonedID_inOriginall);
	
	
	}  
	}
	
	else if($radio_val == 'text'){
	//echo "text";
	 	  if($prdctmeta_namespace == $title_val)
	 {
	$prdctshopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$prdctpostClonedID_inOriginall = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/'.$prdctmeta_id.'"}}}';

             $prdctresponseClonedID_inOriginall = post_to_webpage($prdctshopifyAPIUrll . "/admin/api/2023-01/graphql.json", $prdctpostClonedID_inOriginall);

             $prdctdecode_ClonedID_inOriginall = json_decode($prdctresponseClonedID_inOriginall);
	
	
	} 
}
	
}
	
}
else{
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

//print_r($newresponse);
//die();
foreach($newresponse->metafields as $metafields){
	
	
	 $meta_namespace = $metafields->namespace;
	   $meta_key = $metafields->key;
	 $meta_id = $metafields->id;
	 if($radio_val == 'imgupldd'){
	  if($meta_namespace == $image_val)
	 {
	$shopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginall = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/'.$meta_id.'"}}}';

             $responseClonedID_inOriginall = post_to_webpage($shopifyAPIUrll . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginall);

             $decode_ClonedID_inOriginall = json_decode($responseClonedID_inOriginall);
	
	
	} 
	}
	
	else if($radio_val == 'text'){
	
		  if($meta_namespace == $title_val)
	 {
	$shopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginall = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/'.$meta_id.'"}}}';

             $responseClonedID_inOriginall = post_to_webpage($shopifyAPIUrll . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginall);

             $decode_ClonedID_inOriginall = json_decode($responseClonedID_inOriginall);
	
	
	}
}
	
}
	
}







function post_to_webpage($url, $postData) {

               $options = array(

                

              CURLOPT_HTTPHEADER => array('Content-type: application/json', 'Accept: application/json'),

               CURLOPT_RETURNTRANSFER => true, // return web page

                CURLOPT_HEADER => false, // don't return headers

                CURLOPT_FOLLOWLOCATION => true, // follow redirects

                CURLOPT_MAXREDIRS => 10, // stop after 10 redirects

                CURLOPT_ENCODING => "", // handle compressed

                CURLOPT_USERAGENT => "test", // name of client

                CURLOPT_AUTOREFERER => true, // set referrer on redirect

                CURLOPT_CONNECTTIMEOUT => 120, // time-out on connect

                 CURLOPT_TIMEOUT => 120, // time-out on response

                CURLOPT_POST => true,

                 CURLOPT_POSTFIELDS => $postData

             );

                

              $ch = curl_init($url);

                curl_setopt_array($ch, $options);

              $content = curl_exec($ch);

           curl_close($ch);

            return $content;

                }



?>