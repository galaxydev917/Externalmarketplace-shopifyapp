<?php
  header('Access-Control-Allow-Origin: *');
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://c43c68fa65ad99e9ffb8eae3bd399eb7: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@amconsultingdevstore.myshopify.com/admin/api/2023-01/products.json',
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
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">  

<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
<table id="myTable" class="display">
<thead>
<tr>

    <th>Product Title</th>
   
    <th>Product sku</th>
    
    <th>Share</th>
    
    
</tr>
</thead>
<tbody>
<div id="ex1" class="modal">
    <div id="tabs-1">  
         <ul>  
		 <li><a href="#tabs-3">MarketPlace</a></li>
            <li><a href="#tabs-2">Custom</a></li>  
              
              
         </ul>  
         <!------------------Ecommerce Tab--------------------->
         <div id="tabs-3"> 
<h3>Add Ecommerce Links</h3>		 
<form  data-parsley-validate="" id="variantform">
  <label for="select">Select Variant:</label>
  <select name="vselect" id="vselect" class="varselect" required="">
</select><br><br>
<label for="select">Marketplace Type:</label>
  <select name="pvselect" id="pvselect" class="pvselect" required="">
    <option value="">Choose..</option>
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
   
</select><br><br>

<label for="link">Enter Your Link:</label>
<input type="text" name="vlinks" required="" class="vlinks" value=""><br><br>

<input type="checkbox" id="varval" name="varval" value="varval" onclick="checkstate()" required="">
  <label for="varval"> Use all variant</label><br>

<input type="hidden" name="vlinkdata" class="vlinkdata" value="">
  <input type="submit" value="Update" disabled class="submit_btn  disabled">
  
  <span class="btn disabled" id="remove-btn" disabled>Remove</span>
  
  <p id="vmsg"></p>
  
</form>  

         </div>  
                     <!---------------custom Tab--------------------->
		 <div id="tabs-2">
		 <h3>Add Custom Links </h3>		 
<form  data-parsley-validate="" id="custmtabform" enctype="multipart/form-data">
  <label for="select" class="slctvarr">Select Variant:</label>
  <select name="var-select" id="var-select" class="var-select" required="">
  
</select><br><br>
<label for="radio"> Select Type:</label>
  <input type="radio" name="slctval" id="img-upld" class="slctrad_val" value="imgupldd"/>Image Upload 
<input type="radio" name="slctval" id="text-lnk" class="slctrad_val" value="text"/>Text 
 <br><br>
<div id="showOne" class="imglink" style="display:none;">
  <label for="imgupld">Image Upload:</label>
  <input type="file" id="imgupld" name="imgupld" class="imgupld" required="" ><br><br>
  <div class="imgvalue">
  <input type="hidden" name="image_val" class="img_val" value="">
  <img src="" class="imgvalue"></div>
  <label for="link">Enter Your Link:</label>
  <input type="text" name="imglinks" required="" class="clinks" value="">
</div>

<div id="showtwo" class="textlink" style="display:none;">
<label for="title">Enter Title:</label>
<input type="text" id="title" name="title" class="title" value=""><br><br>
	<label for="link">Enter Your Link:</label>
<input type="text" name="tlinks" required="" class="tlinks" value="">
</div><br>


<input type="hidden" name="clinkdata" class="clinkdata" value="">
  <input type="submit" value="Update" disabled class="update_btn  disabled">
  
  <span class="btn disabled" id="remove-cstdata" disabled>Remove</span>
  
  <p id="vmsgg"></p>
  
</form> 
		 </div>
         
      </div>      
         
        
    </div>
<?php
foreach ($newresponse->products as $product) {



  echo "<tr>
            <td>" . $product->title . "</td>
          
            <td>" . $product->variants[0]->sku . "</td>
           
            <td><a href='#ex1' rel='modal:open' class='linksp' dataid=" . $product->variants[0]->product_id . ">Add Links</a>
			
			</td>
            </tr>";
?>
	
	
	<?php
}
?>
		</tbody>
		</table>
		<script>
		let table = new DataTable('#myTable');
		</script>
		
		<script>
		 function checkstate() {
    document.getElementById('vselect').disabled = document.getElementById('varval').checked;
}
		 $(document).ready(function(){
			 
	$(".linksp").click(function(){
  //alert("The paragraph was clicked.");
	var dataval = $(this).attr("dataid");
	$(".linkdata").val(dataval);
	$(".vlinkdata").val(dataval);
	$(".clinkdata").val(dataval);
	$(".prdid").val(dataval);
	$(".imgvalue").hide();
	 $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/getvariant.php',
       data:{product_id:dataval},
       type:'POST',
       success:function(data){
       $data = $.trim(data)
		
			//console.log(data);
		
	    $("#vselect").html(data);
		
	    $("#var-select").html(data);
		
       $('#variantform')[0].reset();
       $('#custmtabform')[0].reset();
       
	   
	   $('#vselect').prop("disabled", false);
       $('.submit_btn').addClass('disabled');
    $('.submit_btn').removeClass('active');
	$('.submit_btn').prop("disabled", true); 
       $('span').addClass('disabled');
    $('span').removeClass('bactive');
	$('span').prop("disabled", true);
       //location.reload(true); //=== Show Success Message==
       
	 if($data.indexOf("Empty") > -1)
	 {
		 $('.var-select').hide();
		 $('.slctvarr').hide();
	 }
	 else{
		 $('.var-select').show();
		 $('.slctvarr').show();
	 }
	   
	   },
       
     });
 
});
	
  
  /**************** variant form submission****************/
  
   
  $('#variantform').on('submit',function(e) {
  e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
   var vslctval =  $("#vselect").val();
  // alert(vslctval);
   
  
 if ( $(this).parsley().isValid() ) {
     $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/getvariantformdata.php',
       data:$(this).serialize(),
       type:'POST',
       success:function(data){
       //console.log(data); 
	  
	   
       $('#vmsg').text("Link Added Successfully");
        setTimeout(function () {
                     $('#vmsg').html(' ');
                     $('#variantform')[0].reset();
                 }, 3000); 
       
       
       //location.reload(true); //=== Show Success Message==
       },
       
     }); 
   }
  });
  ////////////////
 $('.vlinks').on('change', function() {
	  
     var selctmsval =  $(".pvselect").val();
	 //alert(selctmsval);
	  if(selctmsval != ''){
		  $('.submit_btn').removeClass('disabled');
    $('.submit_btn').addClass('active');
	$('.submit_btn').prop("disabled", false); 
		  	
	  }
});
  
  ///////////////
  $('.pvselect').on('change', function() {
	  
	  var linksval =  $(".vlinks").val();
	//  alert(linksval);
	  if(linksval != ''){
		  $('.submit_btn').removeClass('disabled');
    $('.submit_btn').addClass('active');
	$('.submit_btn').prop("disabled", false); 
		  	
	  }
	  
	 
	var var_slctval =  $(".varselect").val();
	  var markt_slctval =  $(".pvselect").val();
	  
	  var prctid =  $(".vlinkdata").val();
	  //alert(var_slctval);
	  //alert(markt_slctval);
	  if(markt_slctval == ''){
		  $('.submit_btn').addClass('disabled');
    $('.submit_btn').removeClass('active');
	$('.submit_btn').prop("disabled", true); 
       $('span').addClass('disabled');
    $('span').removeClass('bactive');
	$('span').prop("disabled", true);
	  }
	  
	 $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/preloaddata.php',
       data:{varselect:var_slctval,marktselect:markt_slctval,prctid:prctid},
       type:'POST',
       success:function(data){
       
		
		//console.log(data);
			
		 $(".vlinks").val(data);
		if(data != ''){
			$('span').removeClass('disabled');
    $('span').addClass('bactive');
	$('span').prop("disabled", false);
			
		}
       
       //location.reload(true); //=== Show Success Message==
       },
       
     });
	  
	  
	  
	  
  });
  
  /************* Remove Functionality************/
  $("#remove-btn").click(function(){
	  
  
	
	var varableval =  $(".varselect").val();
	var marktplcval =  $(".pvselect").val();
	//alert(varableval);
	
	 $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/removemeta.php',
       data:{varablevalue:varableval,marktplcval:marktplcval},
       type:'POST',
       success:function(data){
       
		alert('Link Deleted successfully');
		$('#variantform')[0].reset();
			//console.log(data);
		
	    //$("#vselect").html(data);
       
       
       
       //location.reload(true); //=== Show Success Message==
       },
       
     });
 
});
  
  
  $('.varselect').on('change', function() {
  
  var variableselct =  $(".varselect").val();
	  var marktplslctval =  $(".pvselect").val();
	  
	  if(variableselct == ''){
		  $('.submit_btn').addClass('disabled');
    $('.submit_btn').removeClass('active');
	$('.submit_btn').prop("disabled", true); 
       $('span').addClass('disabled');
    $('span').removeClass('bactive');
	$('span').prop("disabled", true);
	  }
	  //alert(variableselct);
	 // alert(marktplslctval);
  
  
  $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/preloadselectdata.php',
       data:{variableselct:variableselct,marktplslctval:marktplslctval},
       type:'POST',
       success:function(data){
       
		
		console.log(data);
		
			
		 $(".vlinks").val(data); 
		if(data != ''){
			$('span').removeClass('disabled');
    $('span').addClass('bactive');
	$('span').prop("disabled", false);
			
		}
       
       //location.reload(true); //=== Show Success Message==
       },
       
     });
  
  
  
    });
  
  
  $(".vlinks").keyup(function(){
 $('.submit_btn').removeClass('disabled');
    $('.submit_btn').addClass('active');
	$('.submit_btn').prop("disabled", false);
});
  /****************************custom-tab-functionaliy*************************/
  $('#img-upld').click(function(){
	$("#showtwo").hide();
	$("#showOne").show();
	  
 });
  $('#text-lnk').click(function(){
	 $("#showOne").hide();
	  $("#showtwo").show();
  });
  $('.clinks').keyup(function(){
	  var imgupld_value =  $("#imgupld").val();
	  var imglink_value =  $(".clinks").val();
	  var varslct_value =  $(".var-select").val();
	  if(imgupld_value != '' && imglink_value != '' && varslct_value !=''){
		  $('.update_btn').removeClass('disabled');
    $('.update_btn').addClass('active');
	$('.update_btn').prop("disabled", false);
		  
	  }
	  else{
		  $('.update_btn').addClass('disabled');
    $('.update_btn').removeClass('active');
	$('.update_btn').prop("disabled", true); 
	  }
  });
  $('.imgupld').on('change', function(){
	  var imgupld_value =  $("#imgupld").val();
	  var imglink_value =  $(".clinks").val();
	  var varslct_value =  $(".var-select").val();
	  if(imgupld_value != '' && imglink_value != '' && varslct_value !=''){
		  $('.update_btn').removeClass('disabled');
    $('.update_btn').addClass('active');
	$('.update_btn').prop("disabled", false);
		  
	  }
	  else{
		  $('.update_btn').addClass('disabled');
    $('.update_btn').removeClass('active');
	$('.update_btn').prop("disabled", true); 
	  }
  });
  $('.var-select').on('change', function() { 
  var imgupld_value =  $("#imgupld").val();
	  var imglink_value =  $(".clinks").val();
	  var varslct_value =  $(".var-select").val();
	  var title_value =  $("#title").val();
	  var titlelink_value =  $(".tlinks").val();
	  var varslct_value =  $(".var-select").val();
	  if(imgupld_value != '' && imglink_value != '' && varslct_value !=''){
		  $('.update_btn').removeClass('disabled');
    $('.update_btn').addClass('active');
	$('.update_btn').prop("disabled", false);
		  
	  }
	  else if(title_value != '' && titlelink_value != '' && varslct_value !=''){
		  $('.update_btn').removeClass('disabled');
    $('.update_btn').addClass('active');
	$('.update_btn').prop("disabled", false);
		 
	  }
	  else{
		  
		 $('.update_btn').addClass('disabled');
    $('.update_btn').removeClass('active');
	$('.update_btn').prop("disabled", true); 
	  }
	  
	  
  });
   $('.tlinks').keyup(function(){
	  var title_value =  $("#title").val();
	  var titlelink_value =  $(".tlinks").val();
	  var varslct_value =  $(".var-select").val();
	  if(title_value != '' && titlelink_value != '' && varslct_value !=''){
		  $('.update_btn').removeClass('disabled');
    $('.update_btn').addClass('active');
	$('.update_btn').prop("disabled", false);
		  
	  }
	  
	  else{
		  $('.update_btn').addClass('disabled');
    $('.update_btn').removeClass('active');
	$('.update_btn').prop("disabled", true); 
	  }
  });
  $('.title').keyup(function(){
	  var title_value =  $("#title").val();
	  var titlelink_value =  $(".tlinks").val();
	  var varslct_value =  $(".var-select").val();
	  if(title_value != '' && titlelink_value != '' && varslct_value !=''){
		  $('.update_btn').removeClass('disabled');
    $('.update_btn').addClass('active');
	$('.update_btn').prop("disabled", false);
		  
	  }
	  
	  else{
		  $('.update_btn').addClass('disabled');
    $('.update_btn').removeClass('active');
	$('.update_btn').prop("disabled", true); 
	  }
  });
  
  /********Form submission*********/
  
   $('#custmtabform').on('submit',function(e) {
  e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
   //var vslctval =  $("#vselect").val();
  // alert(vslctval);
   var formData = new FormData(this);
  
 if ( $(this).parsley().isValid() ) {
     $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/custom-formsubmission.php',
       data:formData,
       type:'POST',
       success:function(data){
       console.log(data); 
	  
	   
       $('#vmsgg').text("Link Added Successfully");
        setTimeout(function () {
                     $('#vmsgg').html(' ');
                     $('#custmtabform')[0].reset();
                 }, 3000);  
       
       
       //location.reload(true); //=== Show Success Message==
       },
	    cache: false,
        contentType: false,
        processData: false
       
     }); 
   }
  });
  
  /************* Preload custom tab data*******************/
  $('.var-select').on('change', function() {
  var variable_val = $(".var-select").val();
  var imgulpd_val = $(".imgupld").val();
  var clinks_val = $(".clinks").val();
  var prdct_id = $(".clinkdata").val();
  
  
  var selected = $('input[name="slctval"]:checked').val();
//alert(variable_val);
  if(selected == 'text'){
	$("#text-lnk").attr('checked', true).trigger('click');
  }
  else if(selected == 'imgupldd') {
	  $("#img-upld").attr('checked', true).trigger('click');
  }
   $.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/preloadcstmtab_data.php',
       data:{variable_val:variable_val,imgulpd_val:imgulpd_val,clinks_val:clinks_val,prdct_id:prdct_id,selected:selected},
       type:'POST',
       success:function(data){
      // console.log(data);
		
	
		var finldata = data.split(",");
		
		var type = finldata[0];
		var name = finldata[1];
		var val = finldata[2];
		var vid = finldata[3];
		
		if(type == 'image'){
			$(".imgvalue").show();
			$(".img_val").val(name);
			$(".imgvalue").attr("src","https://www.codenomad.net/ExternalMarketplaces/Customapp/images/"+vid+"-"+name);
			$(".clinks").val(val);
		}
		else if(type == 'text'){
			$(".title").val(name);
			$(".tlinks").val(val);
			
		} 
	 
		if(data =='Empty'){
			$(".imgvalue").hide();
			$(".clinks").val('');
			$(".title").val('');
			$(".tlinks").val('');
			
		}
		
		else if(data ==''){
			$(".imgvalue").hide();
			$(".clinks").val('');
			$(".title").val('');
			$(".tlinks").val('');
				
		}
       
       //location.reload(true); //=== Show Success Message==
       },
       
     });
   
   
   });
   
   $('.slctrad_val').click(function(){
	    var radioval =  $(this).val();
		var variable_sval = $(".var-select").val();
		var prdct_idd = $(".clinkdata").val();
	  //alert(variable_sval);
  
$.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/preloadcstmdata.php',
       data:{radioval:radioval,variable_sval:variable_sval,prdct_idd:prdct_idd},
       type:'POST',
       success:function(data){
       
		
		//console.log(data);
		if(data !== ''){
			 $('#remove-cstdata').removeClass('disabled');
    $('#remove-cstdata').addClass('cstmactive');
	$('#remove-cstdata').prop("disabled", false);
	
		}
		else{
			$('#remove-cstdata').addClass('disabled');
    $('#remove-cstdata').removeClass('cstmactive');
	$('#remove-cstdata').prop("disabled", true);
			
		}
		var finldata = data.split(",");
		
		var type = finldata[0];
		var name = finldata[1];
		var val = finldata[2];
		var vid = finldata[3];
		
		 if(type == 'image'){
			$(".imgvalue").show();
			$(".img_val").val(name);
			$(".imgvalue").attr("src","https://www.codenomad.net/ExternalMarketplaces/Customapp/images/"+vid+"-"+name);
			$(".clinks").val(val);
		}
		else if(type == 'text'){
			$(".title").val(name);
			$(".tlinks").val(val);
			
		}
	
		
       
       //location.reload(true); //=== Show Success Message==
       },
       
     });




  });
   /*************************Remove Data******************************/
   
  $('#remove-cstdata').click(function(){
  
   var radselected = $('input[name="slctval"]:checked').val();
   var variable_slctval = $(".var-select").val();
   var imagesval = $(".img_val").val();
		var prodct_ids = $(".clinkdata").val();
		var image_linkval = $(".clinks").val();
		var title_val = $(".title").val();
		//alert(radselected);
		$.ajax({
       url:'https://www.codenomad.net/ExternalMarketplaces/Customapp/removecstmtabdata.php',
       data:{radselected:radselected,variable_slctval:variable_slctval,prodct_ids:prodct_ids,imagesval:imagesval,image_linkval:image_linkval,title_val:title_val},
       type:'POST',
       success:function(data){
       
		alert('Link Deleted successfully');
		$('#custmtabform')[0].reset();
		$(".imgvalue").hide();
			console.log(data);
		
	    //$("#vselect").html(data);
       
       
       
       //location.reload(true); //=== Show Success Message==
       },
       
     });
		
  }); 
  
  });
		
		</script>
		 <script>  
         $(function() {  
            $( "#tabs-1" ).tabs();  
         });  
      </script>
<style>
.imgvalue {
    display: none;
}
.imgvalue {
    margin-left: 18%;
}
img.imgvalue {
    width: 100px;
}
input.submit_btn {

      
    margin-left: 120px;
    
}
.active{
	color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 12px;
    margin-left: 120px;
    cursor: pointer;
	border: none;
}
.cstmactive{
	color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 12px;
    
    cursor: pointer;
	border: none;
}
.bactive{
	color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 12px;
	cursor: pointer;
}
.disabled {
    background: #6c757db0;
    color: #fffffff2;
	border : none;
	 padding: 12px;
    border-radius: 3px;
}
button#yes {
    width: 50%;
    padding: 5px;
    float: left;
    cursor: pointer;
}
button#No {
    width: 50%;
    padding: 5px;
    cursor: pointer;
}
.varbtns {
    margin-left: 29%;
    margin-bottom: 10px;
  
}
.varbtns h3 {
    color: white;
}
table {
    width: 100%;
    
}
td {
    border: 1px solid;
    padding: 16px !Important;
    text-align: center;
}
th {
    border: 1px solid black;
}
div#myTable_filter {
    margin-bottom: 15px;
}	
.linksp {text-decoration: none;
    background: #c1131e;
    padding: 10px;
color: white;}
h3 {
    text-align: center;
}
select#pselect {
    width: 240px;
    padding: 7px;
}
select#vselect {
    width: 240px;
    padding: 7px;
	margin-left: 22px;
}
select#pvselect {
    width: 240px;
    padding: 7px;
}
input.vlinks {
    width: 240px;
    padding: 7px;
    margin-left: 15px;
}
 input.links {
    width: 240px;
    padding: 7px;
    margin-left: 11px;
}

 #tabs-1{font-size: 14px;}  
         .ui-widget-header {  
            background:lightpink;  
            border: 1px solid #b9cd6d;  
            color: lightyellow;  
            font-weight: bold;  
         } 
         button#update-btn {
   
    background: #c1131e;
    color: white;
    border: 1px solid #c1131e;
    padding: 6px;
    cursor: pointer;
}
input.clinks {
    margin-left: 5%;
    width: 239px;
    height: 7%;
}
input#imgupld {
    margin-left: 7%;
}
input#img-upld {
    margin-left: 10%;
}
input#title {
    margin-left: 11%;
    width: 240px;
    height: 7%;
}
input.tlinks {
    margin-left: 4%;
    width: 240px;
    height: 7%;
}
input.update_btn {
    margin-left: 40%;
}
select#var-select {
    width: 240px;
    padding: 7px;
    margin-left: 22px;
}
</style>
<?php
curl_close($curl);
