<?php   require '../config.php';?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">  
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
<link rel="stylesheet" href="<?php echo $APP_URL; ?>/Customapp/style/productlist.css">

<?php
  header('Access-Control-Allow-Origin: *');

  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM tbl_accesstokens WHERE shop_name = '".$_GET['shop_name']. "' LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $access_token = $row['access_token'];
  $shop = $row['shop_name'];


  $endpoint = "/admin/api/2023-01/products.json";
  $params = array("status" => "active");
  $headers = array(
    'X-Shopify-Access-Token: '.$access_token,
    'Content-Type: application/json'
  );
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://$shop$endpoint?" . http_build_query($params));
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);
  
  // Parse API response
  $productList = json_decode($response, true);
?>
<table id="productTable"  class="table table-striped table-bordered display" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Product Title</th>
      <th>Product SKU</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($productList['products'] as $product) {?>
    <tr>
    <td><?php  echo $product['title']; ?></td>
      <td><?php echo $product['variants'][0]['sku']; ?></td>
      <td><a href='#add-modal' rel='modal:open' class='linksp' dataid="<?php echo $product['variants'][0]['product_id']; ?>" >Add Links</a></td>
    </tr>
   <?php } ?> 
  </tbody>
</table>

<div id="add-modal" class="modal">
    <div class="spin"></div>

    <div class="modal-header">
      <h3>Add Marketplace Links</h3>		 
    </div>  
    <div class="modal-content" id="modal-content">
      <form  data-parsley-validate id="variantform">
      <input type="hidden" name="access_token" id="access_token" value="<?php echo $access_token; ?>">
      <input type="hidden" name="shop" id="shop" value="<?php echo $shop; ?>">

      <input type="hidden" name="appUrl" id="appUrl" value="<?php echo $APP_URL; ?>">
      <input type="hidden" name="metafield_id" id="metafield_id" value="">
      <div class="input-item">
        <div class="input-label">Select Variant:</div>
        <select name="vselect" id="vselect" class="varselect"></select><br><br>
      </div>
      <div class="input-item">
        <div class="input-label">Marketplace:</div>
        <select name="pvselect" id="pvselect" class="pvselect" >
          <option value="Amazon">Amazon</option>
          <option value="Walmart">Walmart</option>
          <option value="eBay">eBay</option>
          <option value="Etsy">Etsy</option>
          <option value="Rakuten">Rakuten</option>
          <option value="Best-Buy">Best Buy</option>
          <option value="Mercado">Mercado Libre</option>
          <option value="Target">Target</option>
          <option value="Walgreens">Walgreens</option>
          <option value="Rite-Aid">Rite-Aid</option>
          <option value="Custom">Custom</option>
        </select>
      </div>
      <div id="custom-link" style="display:none;">
        <div class="input-item">
          <div class="input-label">Display Type:</div>
          <div style="width: 220px;">
            <input type="radio" name="displaytype" id="radio-img" class="slctrad_val" value="logo" checked/>Logo 
            <input type="radio" name="displaytype" id="radio-txt" class="slctrad_val" value="text"/>Text 
          </div>
        </div>
        <div class="input-item" id="display-logo">
          <div class="input-label">Logo File:</div>
          <div class="input-container" style="width: 220px;">
            <input type="file" id="logoUpload" name="logoUpload" class="logoUpload" required />
          </div>
        </div>  
        <div id="preview-logo"></div>
        <div class="input-item" id="display-text">
          <div class="input-label">Display Text:</div>
          <div class="input-container">
            <input type="text" name="custom-text" id="custom-text" class="display-text" value="" required />
          </div>
        </div>        
      </div>    
      <div class="input-item">
        <div class="input-label">Enter Your Link:</div>
        <div class="input-container"><input type="text" name="vlinks" id="vlinks" required class="vlinks" value=""></div>
      </div>
      <div class="input-item" style="justify-content: start;">
        <input type="checkbox" id="allvariantstatus" name="allvariantstatus">
        <label for="varval"> Add for all variants</label>
      </div>
      <input type="hidden" name="vlinkdata" class="vlinkdata" value="">
      <div class="input-item">
        <input type="submit" value="Update" class="submit_btn">
      </div>
      </form>  
   </div>
</div> 
<script src="<?php echo $APP_URL?>/Customapp/js/productlist.js"></script>




