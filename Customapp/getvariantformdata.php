<?php 

$vrname = $_POST['vselect'];
$getoptiondata = explode(",",$vrname);
$variant_name = $getoptiondata[0];
$strr = str_replace('/', '_', $variant_name);
$strrnew = preg_replace('/\s+/', '', $strr);
$variant_ids = $getoptiondata[1];
$mrkname = $_POST['pvselect'] ;
$link = $_POST['vlinks'] ;
$prdid = $_POST['vlinkdata'] ;

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


foreach($newresponse->metafields as $metafields){
	
	
	   $meta_namespace = $metafields->namespace;
	   $meta_key = $metafields->key;
	  $meta_id = $metafields->id;
	 if($meta_key == $mrkname && $meta_namespace == $variant_name)
	 {
		 
		  
		   $meta_val = $metafields->value;
		
		$shopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginall = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n  productVariantUpdate(input: $input) {\\r\\n    product {\\r\\n\\tid\\r\\n\\t}\\r\\n     productVariant {\\r\\n\\tid\\r\\n\\t}\\r\\n    userErrors{\\r\\n        field\\r\\n        message\\r\\n    }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/'.$variant_ids.'","metafields":[{"id":"gid://shopify/Metafield/'.$meta_id.'","value":"'.$link.'"}]}}}';

             $responseClonedID_inOriginall = post_to_webpage($shopifyAPIUrll . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginall);

             $decode_ClonedID_inOriginall = json_decode($responseClonedID_inOriginall);
	 }
	
	
	
}



curl_close($curl);

if( $_POST['vselect'] == "")
{
	$prdctid = $prdid; 
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


foreach($newresponses->variants as $variant){
	$id = $variant->id;
    $title = $variant->title;
	$str = str_replace('/', '_', $title);
	$strnew=preg_replace('/\s+/', '', $str);
	
	if($title == 'Default Title'){
		
   $shopifyAPIUrrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

   $postClonedID_inOriginaal = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdid . '","metafields":[{"namespace":"'.$mrkname.'","key":"test","value":"' . $link . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginaal = post_to_webpage($shopifyAPIUrrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaal);

             $decode_ClonedID_inOriginaal = json_decode($responseClonedID_inOriginaal);

}
	else{
	$shopifyAPIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginal = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $id . '","metafields":[{"namespace":"'.$strnew.'","key":"'.$mrkname.'","value":"' . $link . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginal = post_to_webpage($shopifyAPIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginal);

             $decode_ClonedID_inOriginal = json_decode($responseClonedID_inOriginal); 
			 sleep(1);
 
}

}
}
else
	
	{
		
		$shopifyAPIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

		$postClonedID_inOriginal = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"'.$strrnew.'","key":"'.$mrkname.'","value":"' . $link . '","type":"single_line_text_field"}]}}}';

             $responseClonedID_inOriginal = post_to_webpage($shopifyAPIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginal);

             $decode_ClonedID_inOriginal = json_decode($responseClonedID_inOriginal); 
		
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