<?php 
//print_r($_POST);
//print_r($_FILES);

$var_slctvalue = $_POST['var-select'];
$getoptiondata = explode(",",$var_slctvalue);
$variant_name = $getoptiondata[0];
$variant_ids = $getoptiondata[1];
$radioslctype_value = $_POST['slctval'];
$img_linkval = $_POST['imglinks'];
$texttitle_val = $_POST['title'];
$textlink_val = $_POST['tlinks'];
$prdctid= $_POST['clinkdata'];
$image_name = $_FILES['imgupld']['name'];


 
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

if($radioslctype_value == 'imgupldd')
 {
	//echo "imgselect";
	foreach($newresponses->variants as $variant){
	$id = $variant->id;
    $title = $variant->title;
	$str = str_replace('/', '_', $title);
	$strnew=preg_replace('/\s+/', '', $str);
	
	if($title == 'Default Title'){
		//echo "products";
  $filename   = $prdctid . "-" . $image_name; // 5dab1961e93a7-1571494241
$extension  = pathinfo( $_FILES["imgupld"]["name"], PATHINFO_EXTENSION ); // jpg
$basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

$source       = $_FILES["imgupld"]["tmp_name"];
 $destination  = "images/{$basename}";

/* move the file */
move_uploaded_file( $source, $destination );

//echo "Stored in: {$destination}"; 

$shopifyAPIUrrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

   $postClonedID_inOriginaal = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdctid . '","metafields":[{"namespace":"'.$image_name.'","key":"Image","value":"' . $img_linkval . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginaal = post_to_webpage($shopifyAPIUrrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaal);

             $decode_ClonedID_inOriginaal = json_decode($responseClonedID_inOriginaal);

}
else{
	
	
	//echo "varinats";
	 $filename   = $variant_ids . "-" . $image_name; // 5dab1961e93a7-1571494241
$extension  = pathinfo( $_FILES["imgupld"]["name"], PATHINFO_EXTENSION ); // jpg
$basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg

$source       = $_FILES["imgupld"]["tmp_name"];
 $destination  = "images/{$basename}";

/* move the file */
move_uploaded_file( $source, $destination );

//echo "Stored in: {$destination}"; 
$shopifyAPIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginal = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"'.$image_name.'","key":"Image","value":"' .$img_linkval . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginal = post_to_webpage($shopifyAPIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginal);

             $decode_ClonedID_inOriginal = json_decode($responseClonedID_inOriginal); 
			 sleep(1);

}
}
	
}
else{
	//echo "Text";
	
	foreach($newresponses->variants as $variant){
	$id = $variant->id;
    $title = $variant->title;
	$str = str_replace('/', '_', $title);
	$strnew=preg_replace('/\s+/', '', $str);
	
	if($title == 'Default Title'){
		//echo "products";
  

//echo "Stored in: {$destination}"; 

$shopifyAPIIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

   $postClonedID_inOriginaal = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdctid . '","metafields":[{"namespace":"'.$texttitle_val.'","key":"Text","value":"' . $textlink_val . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginaall = post_to_webpage($shopifyAPIIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaal);

             $decode_ClonedID_inOriginaall = json_decode($responseClonedID_inOriginaall);

}
else{
	
	
	//echo "varinats";
	

//echo "Stored in: {$destination}"; 
$shopifyAPIUUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginnal = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"'.$texttitle_val.'","key":"Text","value":"' .$textlink_val . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginnal = post_to_webpage($shopifyAPIUUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginnal);

             $decode_ClonedID_inOriginnall = json_decode($responseClonedID_inOriginnal); 
			 sleep(1);

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