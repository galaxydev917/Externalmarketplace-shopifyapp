<?php
header('Access-Control-Allow-Origin: *');
$variantIDS = $_POST['variantdata'];
 $prductid = $_POST['productid'];



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prductid.'/variants.json',
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
;

if($newresponsesprdct->variants[0]->title == 'Default Title'){
	
	curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products/'.$prductid.'/metafields.json',
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
	
	//echo $namesapce =newresponses->metafields[0]->namespace;
	echo '<div class="grid-container" style ="display: grid; grid-template-columns: auto auto auto; ">';
	foreach($newresponses->metafields as $metafield){
	
	 
		echo '<div class="grid-item" style ="text-align: center;">';
		
	  echo '<a href="'.$metafield->value.'">';
		$namespace = $metafield->namespace;
		$key = $metafield->key;
		
		if($namespace == 'Amazon'){
		  
		  echo '<img src="https://thumbs.dreamstime.com/b/simple-vector-filled-flat-amazon-icon-logo-solid-black-pictogram-isolated-white-background-amazon-logo-159029074.jpg" width="100px" style= "margin-top: 10px;">';
	  }
	  elseif($namespace == 'eBay'){
		  echo'<img src="https://codenomad.net/ExternalMarketplaces/1200px-EBay_logo.svg.jpg" width="100px" style="margin-top: 16px;">';
	  }
	  elseif($namespace == 'Walmart'){
		  echo'<img src="https://1000logos.net/wp-content/uploads/2017/05/Walmart-Logo.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($namespace == 'Etsy'){
		  echo'<img src="https://cdn.iconscout.com/icon/free/png-256/etsy-282219.png" width="60px" style="margin-left: 16px;">';
	  }
	  elseif($namespace == 'Rakuten'){
		  echo'<img src="https://static.rakuten.com/static/svg/rakuten/rak-logo-brand-v1.svg" width="100px" style="margin-left: 16px; margin-top: 14px;">';
	  }
	  elseif($namespace == 'Best-Buy'){
		  echo'<img src="https://corporate.bestbuy.com/wp-content/uploads/2018/05/2018_rebrand_blog_logo_LEAD_ART.jpg" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($namespace == 'Mercado'){
		  echo '<img src="https://upload.wikimedia.org/wikipedia/commons/0/06/Mercado_Logo.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($namespace == 'Target'){
		  echo'<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Target_Logo_%282%29.svg/2560px-Target_Logo_%282%29.svg.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($namespace == 'Walgreens'){
		  echo'<img src="https://www.walgreens.com/images/adaptive/si/1485908_WAG_Signature_logo_RGB_750x208.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($namespace == 'Rite-Aid'){
		  echo'<img src="https://cloudfront-us-east-1.images.arcpublishing.com/advancelocal/B7NQKWV5SZD3TP63FIZITMPVZY.jpg" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($key == 'Image'){
		  echo'<img src="https://www.codenomad.net/ExternalMarketplaces/Customapp/images/'.$prductid.'-'.$namespace.'" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($key == 'Text'){
		  echo $namespace;
	  }
		
		echo '</a>';	
	  echo '</div>';
	}
	echo '</div>';
}

else{

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/variants/'.$variantIDS.'/metafields.json',
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

	
	  
	  echo '<div class="grid-container" style ="display: grid; grid-template-columns: auto auto auto; ">';
foreach($newresponse->metafields as $metafields){
	  echo '<div class="grid-item" style ="text-align: center;">';
	  echo '<a href="'.$metafields->value.'">';
	  $meta_key = $metafields->key;
	  $meta_namespace = $metafields->namespace;
	  if($meta_key == 'Amazon'){
		  
		  echo '<img src="https://thumbs.dreamstime.com/b/simple-vector-filled-flat-amazon-icon-logo-solid-black-pictogram-isolated-white-background-amazon-logo-159029074.jpg" width="100px" style= "margin-top: 10px;">';
	  }
	  elseif($meta_key == 'eBay'){
		  echo'<img src="https://codenomad.net/ExternalMarketplaces/1200px-EBay_logo.svg.jpg" width="100px" style="margin-top: 16px;">';
	  }
	  elseif($meta_key == 'Walmart'){
		  echo'<img src="https://1000logos.net/wp-content/uploads/2017/05/Walmart-Logo.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Etsy'){
		  echo'<img src="https://cdn.iconscout.com/icon/free/png-256/etsy-282219.png" width="60px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Rakuten'){
		  echo'<img src="https://static.rakuten.com/static/svg/rakuten/rak-logo-brand-v1.svg" width="100px" style="margin-left: 16px; margin-top: 14px;">';
	  }
	  elseif($meta_key == 'Best-Buy'){
		  echo'<img src="https://corporate.bestbuy.com/wp-content/uploads/2018/05/2018_rebrand_blog_logo_LEAD_ART.jpg" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Mercado'){
		  echo '<img src="https://upload.wikimedia.org/wikipedia/commons/0/06/Mercado_Logo.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Target'){
		  echo'<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Target_Logo_%282%29.svg/2560px-Target_Logo_%282%29.svg.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Walgreens'){
		  echo'<img src="https://www.walgreens.com/images/adaptive/si/1485908_WAG_Signature_logo_RGB_750x208.png" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Rite-Aid'){
		  echo'<img src="https://cloudfront-us-east-1.images.arcpublishing.com/advancelocal/B7NQKWV5SZD3TP63FIZITMPVZY.jpg" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Image'){
		  echo'<img src="https://www.codenomad.net/ExternalMarketplaces/Customapp/images/'.$variantIDS.'-'.$meta_namespace.'" width="100px" style="margin-left: 16px;">';
	  }
	  elseif($meta_key == 'Text'){
		  
		  echo $meta_namespace;
	  }
	 
	  echo '</a>';	
	  echo '</div>';	
	  
}
echo '</div>';
}

	 
curl_close($curl);


?>