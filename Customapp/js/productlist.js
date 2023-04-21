var appURL =  $("#appUrl").val();
var isCheckedAll = false;
var  productId = '';
var displayTypeForCustom = 'logo';
var fileInput = $('#logoUpload')[0];

$(document).ready(function () {
    $('#productTable').DataTable();
    $('.dataTables_length').addClass('bs-select');
    $('#radio-img').prop('checked', true);


	$(".linksp").click(function(){
        initialLoadingStatus();
        var dataval = $(this).attr("dataid");
        productId = dataval;
        $('#vlinks').val('');
        $('#allvariantstatus').prop('checked', false);
        $('#vselect').find('option').remove();

        if($('#pvselect').val() === "Custom"){ 
            if(displayTypeForCustom === 'logo'){
                $('#display-logo').css('display', 'flex');
                $('#display-text').css('display', 'none');
                $('input[name="custom-text"]').prop('required', false);
                $('input[name="logoUpload"').prop('required', true);
            }else{
                $('#display-logo').css('display', 'none');
                $('#display-text').css('display', 'flex');
                $('input[name="custom-text"]').prop('required', true);
                $('input[name="logoUpload"').prop('required', false);
            }
        }
        if($('#pvselect').val() !== "Custom"){
            $('input[name="logoUpload"').prop('required', false);
            $('input[name="custom-text"]').prop('required', false);
        }        

        $.ajax({
            url: appURL + '/Customapp/api/getvariant.php',
            dataType: 'json',
            data:{
                product_id: dataval,
                access_token: $('#access_token').val(),
                shop: $('#shop').val(),
            },
            type:'POST',
            success:function(response){
                var data = JSON.parse(response);
                if(data.variants.length == 1 && data.variants[0].title === "Default Title"){
                    $('#vselect').prop('disabled', true);
                    $('#allvariantstatus').prop('disabled', true);
                    getMetaFiledData(null, $('#pvselect').val(), dataval);

                    return;
                }
                $('#vselect').prop('disabled', false);
                $('#allvariantstatus').prop('disabled', false);

                for(var i=0; i< data.variants.length; i++){
                    var option = $('<option>');
                    option.val(data.variants[i].id);
                    option.text(data.variants[i].title);
                    $('#vselect').append(option);
                }
                getMetaFiledData($('#vselect').val(), $('#pvselect').val(), dataval);
            },
        });
    });
    
    // $('#update').click(function(){
    //     initialLoadingStatus();
    //     $.ajax({
    //         url: appURL + '/Customapp/api/addAndUpdateLink.php',
    //         dataType: 'json',
    //         data:{
    //             metafield_id: $('#metafield_id').val(),
    //             variantId: $('#vselect').val(),
    //             marketId:  $('#pvselect').val(),
    //             isCheckedAll: isCheckedAll,
    //             productId: productId,
    //             marketLink: $('#vlinks').val(),
    //             access_token: $('#access_token').val(),
    //             shop: $('#shop').val(),
    //         },
    //         type:'POST',
    //         success:function(response){
    //             finishLoadingStatus();
    //             if($('#vselect').val() == null || $('#vselect').val() == ''){
    //                 $('#vselect').prop('disabled', true);
    //                 $('#allvariantstatus').prop('disabled', true);
    //             }
    //             $('#allvariantstatus').prop('checked', false);

    //         },
    //     });
    // });   
    
    $('#allvariantstatus').change(function(){
        if($(this).is(":checked")) {
            isCheckedAll = true;
            $('#vselect').prop('disabled', true);
            getMetaFiledData(null, $('#pvselect').val(), productId);
        } else {
            isCheckedAll = false;
            $('#vselect').prop('disabled', false);
            getMetaFiledData($('#vselect').val(), $('#pvselect').val(), productId);
        }
    });

    // $('#vlinks').on('input', function() {
    //     var inputValue = $(this).val();
    //     if(inputValue == '' || ($('#pvselect').val() === "Custom" && (displayTypeForCustom == "text" && $('#custom-text').val() == '') || (displayTypeForCustom == "logo" && $('#logoUpload').val() == ''))){
    //         $('#update').prop('disabled', true);
    //         $('.submit_btn').addClass('disabled');
    //     }
    //     else{
    //         $('#update').prop('disabled', false);
    //         $('.submit_btn').removeClass('disabled');
    //     }
    // });

    $('#vselect').change(function() {
        var selectedOption = $(this).val();
        getMetaFiledData(selectedOption, $('#pvselect').val(), productId);
        // Do something with the selected option
    });

    $('#pvselect').change(function() {
        var selectedOption = $(this).val();
        if(selectedOption === "Custom"){ 
            $('#custom-link').css('display', 'block');
            console.log(displayTypeForCustom)
            if(displayTypeForCustom === 'logo'){

                $('#display-logo').css('display', 'flex');
                $('#display-text').css('display', 'none');
                $('input[name="custom-text"]').prop('required', false);
                $('input[name="logoUpload"').prop('required', true);
            }else{
                $('#display-logo').css('display', 'none');
                $('#display-text').css('display', 'flex');
                $('input[name="custom-text"]').prop('required', true);
                $('input[name="logoUpload"').prop('required', false);
            }
        }else{
            $('#custom-link').css('display', 'none');
        }
        getMetaFiledData($('#vselect').val(), selectedOption, productId);
    });

    $('input[name="displaytype"]').on('change', function() {
        displayTypeForCustom = $('input[name="displaytype"]:checked').val();
        if(displayTypeForCustom === 'logo'){
            $('#display-logo').css('display', 'flex');
            $('#display-text').css('display', 'none');
            $('input[name="custom-text"]').prop('required', false);
            $('input[name="logoUpload"').prop('required', true);

        }
        else{
            $('#display-logo').css('display', 'none');
            $('#display-text').css('display', 'flex');
            $('input[name="custom-text"]').prop('required', true);
            $('input[name="logoUpload"').prop('required', false);

        }
    });    

    $(fileInput).on('change', function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function() {
          var dataURL = reader.result;
          var img = $('<img>').attr('src', dataURL);
          $('#preview-logo').append(img);
        };
        reader.readAsDataURL(file);
    });

    $('#variantform').submit(function(e) {
        e.preventDefault();
        alert("a");
    })
   
});

function initialLoadingStatus(){
    $('.spin').addClass('show-spinner');
    $('.modal-content').addClass('opacity');
    $("#modal-content").find("*").prop("disabled", true);
    
}

function finishLoadingStatus(){
    $('.spin').addClass('hide-spinner');
    $('.spin').removeClass('show-spinner');
    $('.modal-content').removeClass('opacity');
    $("#modal-content").find("*").prop("disabled", false);

}

function getMetaFiledData(variantId, marketId, productId){
    $.ajax({
        url: appURL + '/Customapp/api/getmetafieldsdata.php',
        dataType: 'json',
        data:{
            productId: productId,
            variantId: variantId,
            marketId:  marketId,
            access_token: $('#access_token').val(),
            shop: $('#shop').val(),
        },
        type:'POST',
        success:function(response){
            finishLoadingStatus();
            if(variantId === null) 
                $('#vselect').prop('disabled', true);

            var data = JSON.parse(response);
            if(data.metafields.length > 0 && data.metafields[0].id){
                
                $('#metafield_id').val(data.metafields[0].id);
                $('#vlinks').val(data.metafields[0].value);
                // $('#update').prop('disabled', false);
                // $('.submit_btn').removeClass('disabled');

            }else{
                // $('#update').prop('disabled', true);
                // $('.submit_btn').addClass('disabled');
                $('#metafield_id').val('');
                $('#vlinks').val('');

            }
        },
    });
}