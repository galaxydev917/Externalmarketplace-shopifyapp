<?php
    require 'config.php';
    header('Access-Control-Allow-Origin: *');
    $params = $_GET; 
    print_r($params);
    // $hmac = $_GET['hmac'];
    // $params = array_diff_key($params, array('hmac' => ''));
    // ksort($params); 
    // $computed_hmac = hash_hmac('sha256', http_build_query($params), $SECRET_KEY);

    // // Use hmac data to check that the response is from Shopify or not
    // if (hash_equals($hmac, $computed_hmac)) {
    //     $query = array(
    //         "client_id" => $API_KEY, 
    //         "client_secret" => $SECRET_KEY, 
    //         "code" => $params['code']
    //     );
    //     // Generate access token URL
    //     $access_token_url = "https://" . $params['shop'] . "/admin/oauth/access_token";

    //     // Configure curl client and execute request
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_URL, $access_token_url);
    //     curl_setopt($ch, CURLOPT_POST, count($query));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
    //     $result = curl_exec($ch);
    //     curl_close($ch);
    //     $data = json_decode($result, true);
    //     print_r($data);
        // $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        // if (!$conn) {
        //     die("Connection failed: " . mysqli_connect_error());
        // }
        // $shop_name = mysqli_real_escape_string($conn, $params['shop']);
        // $access_token = mysqli_real_escape_string($conn, $data['access_token']);

        // $sql = "INSERT INTO tbl_accesstokens (shop_name, access_token) VALUES ('$shop_name', '$access_token')";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Access token Stored successfully";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }
        // header("Location:". $APP_URL."/Customapp/index.php/?shop_name=".$shop_name);
        // exit();
    }
    else 
        die('This request is NOT from Shopify!');
?>