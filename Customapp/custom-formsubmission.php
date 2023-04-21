<?php

//print_r($_POST);
//print_r($_FILES);

$var_slctvalue = $_POST['var-select'];
$getoptiondata = explode(",", $var_slctvalue);
$variant_name = $getoptiondata[0];
$variant_ids = $getoptiondata[1];
$radioslctype_value = $_POST['slctval'];
$img_linkval = $_POST['imglinks'];
$texttitle_val = $_POST['title'];
$textlink_val = $_POST['tlinks'];
$prdctid = $_POST['clinkdata'];
$image_name = $_FILES['imgupld']['name'];
$imageval_name = $_POST['image_val'];



$currl = curl_init();

curl_setopt_array($currl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/' . $prdctid . '/variants.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$responsesprdct = curl_exec($currl);
$newresponsesprdct = json_decode($responsesprdct);

//print_r($newresponsesprdct); 



if ($newresponsesprdct->variants[0]->title == 'Default Title') {
  echo "produts";
  $cuurl = curl_init();
  curl_setopt_array($cuurl, array(
    CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/' . $prdctid . '/metafields.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',  ));
  $prdctresponse = curl_exec($cuurl);  $prdctnewresponse = json_decode($prdctresponse);  //print_r($prdctnewresponse);
  foreach ($prdctnewresponse->metafields as $prdctmetafields) {


    $prdctmeta_namespace = $prdctmetafields->namespace;
    $prdctmeta_key = $prdctmetafields->key;
    $prdctmeta_id = $prdctmetafields->id;
    if ($prdctmeta_namespace == $imageval_name) {

      //echo "values matcgh";


      $metashopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $mprdctpostClonedID_inOriginalml = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/' . $prdctmeta_id . '"}}}';

      $mprdctresponseClonedID_inOriginalml = post_to_webpage($metashopifyAPIUrll . "/admin/api/2023-01/graphql.json", $mprdctpostClonedID_inOriginalml);

      $mprdctdecode_ClonedID_inOriginalml = json_decode($mprdctresponseClonedID_inOriginalml);
      break;


      $filename = $variant_ids . "-" . $image_name; // 5dab1961e93a7-1571494241      $extension = pathinfo($_FILES["imgupld"]["name"], PATHINFO_EXTENSION); // jpg      $basename = $filename; // 5dab1961e93a7_1571494241.jpg
      $source = $_FILES["imgupld"]["tmp_name"];
      $destination = "images/{$basename}";
      /* move the file */      move_uploaded_file($source, $destination);
      //echo "Stored in: {$destination}";       $shopifyAPIUrrlme = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginaalme = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdctid . '","metafields":[{"namespace":"' . $image_name . '","key":"Image","value":"' . $img_linkval . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginaalme = post_to_webpage($shopifyAPIUrrlme . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaalme);

      $decode_ClonedID_inOriginaalme = json_decode($responseClonedID_inOriginaalme);
      sleep(1);



    }

    else if ($prdctmeta_namespace == $texttitle_val) {

      //echo "values matcgh";

      $prdctshopifyAPIUrllmt = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $prdctpostClonedID_inOriginallmt = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/' . $prdctmeta_id . '"}}}';

      $prdctresponseClonedID_inOriginallmt = post_to_webpage($prdctshopifyAPIUrllmt . "/admin/api/2023-01/graphql.json", $prdctpostClonedID_inOriginallmt);

      $prdctdecode_ClonedID_inOriginallmt = json_decode($prdctresponseClonedID_inOriginallmt);

      $shopifyAPIIUrlte = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginaalte = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdctid . '","metafields":[{"namespace":"' . $texttitle_val . '","key":"Text","value":"' . $textlink_val . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginaallte = post_to_webpage($shopifyAPIIUrlte . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaalte);

      $decode_ClonedID_inOriginaallte = json_decode($responseClonedID_inOriginaallte);
      sleep(1);
    }

  
}



  
curl_close($cuurl);

}
else {
  echo "variants";



  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/variants/' . $variant_ids . '/metafields.json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',  ));
  $response = curl_exec($curl);  $newresponse = json_decode($response);

  foreach ($newresponse->metafields as $metafields) {


    $meta_namespace = $metafields->namespace;
    $meta_key = $metafields->key;
    $meta_id = $metafields->id;
    if ($meta_namespace == $imageval_name) {

      //echo "values matcgh";


      $mprdctshopifyAPIUrll = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $mprdctpostClonedID_inOriginall = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/' . $meta_id . '"}}}';

      $mprdctresponseClonedID_inOriginall = post_to_webpage($mprdctshopifyAPIUrll . "/admin/api/2023-01/graphql.json", $mprdctpostClonedID_inOriginall);

      $mprdctdecode_ClonedID_inOriginall = json_decode($mprdctresponseClonedID_inOriginall);


      $filename = $variant_ids . "-" . $image_name; // 5dab1961e93a7-1571494241      $extension = pathinfo($_FILES["imgupld"]["name"], PATHINFO_EXTENSION); // jpg      $basename = $filename; // 5dab1961e93a7_1571494241.jpg
      $source = $_FILES["imgupld"]["tmp_name"];
      $destination = "images/{$basename}";
      /* move the file */      move_uploaded_file($source, $destination);
      //echo "Stored in: {$destination}";       $shopifyAPIUrlm = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginalm = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"' . $image_name . '","key":"Image","value":"' . $img_linkval . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginalm = post_to_webpage($shopifyAPIUrlm . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginalm);

      $decode_ClonedID_inOriginalm = json_decode($responseClonedID_inOriginalm);
      sleep(1);



    }

    else if ($meta_namespace == $texttitle_val) {

      //echo "values matcgh";

      $prdctshopifyAPIUrllm = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $prdctpostClonedID_inOriginallm = '{"query":"mutation metafieldDelete($input: MetafieldDeleteInput!) {\\r\\n  metafieldDelete(input: $input) {\\r\\n    deletedId\\r\\n    userErrors {\\r\\n      field\\r\\n      message\\r\\n    }\\r\\n  }\\r\\n}","variables":{"input":{"id":"gid://shopify/Metafield/' . $meta_id . '"}}}';

      $prdctresponseClonedID_inOriginallm = post_to_webpage($prdctshopifyAPIUrllm . "/admin/api/2023-01/graphql.json", $prdctpostClonedID_inOriginallm);

      $prdctdecode_ClonedID_inOriginallm = json_decode($prdctresponseClonedID_inOriginallm);
      sleep(1);
      $shopifyAPIUUrlcm = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginnalcm = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"' . $texttitle_val . '","key":"Text","value":"' . $textlink_val . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginnalcm = post_to_webpage($shopifyAPIUUrlcm . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginnalcm);

      $decode_ClonedID_inOriginnallcm = json_decode($responseClonedID_inOriginnalcm);
      sleep(1);
    }

  
}


  curl_close($curl);

}
curl_close($currl);
//die();




$curll = curl_init();

curl_setopt_array($curll, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/' . $prdctid . '/variants.json',
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

if ($radioslctype_value == 'imgupldd') {
  //echo "imgselect";
  foreach ($newresponses->variants as $variant) {
    $id = $variant->id;
    $title = $variant->title;
    $str = str_replace('/', '_', $title);
    $strnew = preg_replace('/\s+/', '', $str);

    if ($title == 'Default Title') {
      //echo "products";
      $filename = $prdctid . "-" . $image_name; // 5dab1961e93a7-1571494241      $extension = pathinfo($_FILES["imgupld"]["name"], PATHINFO_EXTENSION); // jpg      $basename = $filename; // 5dab1961e93a7_1571494241.jpg
      $source = $_FILES["imgupld"]["tmp_name"];
      $destination = "images/{$basename}";
      /* move the file */      move_uploaded_file($source, $destination);
      //echo "Stored in: {$destination}"; 
      $shopifyAPIUrrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginaal = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdctid . '","metafields":[{"namespace":"' . $image_name . '","key":"Image","value":"' . $img_linkval . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginaal = post_to_webpage($shopifyAPIUrrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaal);

      $decode_ClonedID_inOriginaal = json_decode($responseClonedID_inOriginaal);
    }    else {


      //echo "varinats";
      $filename = $variant_ids . "-" . $image_name; // 5dab1961e93a7-1571494241      $extension = pathinfo($_FILES["imgupld"]["name"], PATHINFO_EXTENSION); // jpg      $basename = $filename; // 5dab1961e93a7_1571494241.jpg
      $source = $_FILES["imgupld"]["tmp_name"];
      $destination = "images/{$basename}";
      /* move the file */      move_uploaded_file($source, $destination);
      //echo "Stored in: {$destination}";       $shopifyAPIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginal = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"' . $image_name . '","key":"Image","value":"' . $img_linkval . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginal = post_to_webpage($shopifyAPIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginal);

      $decode_ClonedID_inOriginal = json_decode($responseClonedID_inOriginal);
      sleep(1);
    }  }


}
else {
  //echo "Text";

  foreach ($newresponses->variants as $variant) {
    $id = $variant->id;
    $title = $variant->title;
    $str = str_replace('/', '_', $title);
    $strnew = preg_replace('/\s+/', '', $str);

    if ($title == 'Default Title') {
      //echo "products";


      
//echo "Stored in: {$destination}"; 
      $shopifyAPIIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginaal = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $prdctid . '","metafields":[{"namespace":"' . $texttitle_val . '","key":"Text","value":"' . $textlink_val . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginaall = post_to_webpage($shopifyAPIIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginaal);

      $decode_ClonedID_inOriginaall = json_decode($responseClonedID_inOriginaall);
    }    else {


      //echo "varinats";


      
//echo "Stored in: {$destination}";       $shopifyAPIUUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";

      $postClonedID_inOriginnal = '{"query":"mutation productVariantUpdate($input: ProductVariantInput!) {\\r\\n    productVariantUpdate(input: $input) {\\r\\n      productVariant {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/ProductVariant/' . $variant_ids . '","metafields":[{"namespace":"' . $texttitle_val . '","key":"Text","value":"' . $textlink_val . '","type":"single_line_text_field"}]}}}';

      $responseClonedID_inOriginnal = post_to_webpage($shopifyAPIUUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginnal);

      $decode_ClonedID_inOriginnall = json_decode($responseClonedID_inOriginnal);
      sleep(1);
    }  }


}


function post_to_webpage($url, $postData)
{

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