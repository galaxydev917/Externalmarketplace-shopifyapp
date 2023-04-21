<?php 


 $pselect = $_POST['pselect'] ;
 $links = $_POST['links'] ;
 $linkdata = $_POST['linkdata'] ;
    
    $shopifyAPIUrl = "https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com";
$postClonedID_inOriginal = '{"query":"mutation productUpdate($input: ProductInput!) {\\r\\n    productUpdate(input: $input) {\\r\\n      product {\\r\\n        id\\r\\n      }\\r\\n      userErrors {\\r\\n        field\\r\\n        message\\r\\n      }\\r\\n    }\\r\\n  }","variables":{"input":{"id":"gid://shopify/Product/' . $linkdata . '","metafields":[{"namespace":"'.$pselect.'","key":"test","value":"' . $links . '","type":"single_line_text_field"}]}}}';
             $responseClonedID_inOriginal = post_to_webpage($shopifyAPIUrl . "/admin/api/2023-01/graphql.json", $postClonedID_inOriginal);
             $decode_ClonedID_inOriginal = json_decode($responseClonedID_inOriginal); 
             
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