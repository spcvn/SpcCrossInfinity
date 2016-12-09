$(function () {
	$('.popup-modal').magnificPopup({
		type: 'inline',
		preloader: false,
		callbacks: {
			beforeOpen: function() {
				$('.drawr').hide();
				$('.menu_btn').removeClass('peke');
			}
		}
	});
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
});

//REMOVE PARAMS FROM URL
function removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts = url.split('?');
    if (urlparts.length >= 2) {

        var prefix = encodeURIComponent(parameter) + '=';
        var pars = urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i = pars.length; i-- > 0;) {
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }

        url = urlparts[0] + '?' + pars.join('&');
        return url;
    } else {
        return url;
    }
}


//GET VALUE PARAMS BY NAME FROM URL
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



function hidePHPMessage(){
    $('.error-controller').hide();
}

/**
 * Hide error message PHP
 **/
function hidePHPMessageByName(item_name){
    $('.error-'+item_name).hide();
}

checkFormHasData();
function checkFormHasData(){
    $('#form_has_data').val('0');
    
    var tmp_reward_content = $('#tmp_reward_content').val();

    var tmp_reward_point_rate = $('#tmp_reward_point_rate').val();
    var tmp_reward_point = $('#tmp_reward_point').val();

    var tmp_discount_price = $('#tmp_discount_price').val();
    var tmp_discount_rate = $('#tmp_discount_rate').val();

    var tmp_applied_lowest_price = $('#tmp_Tel').val();
    var tmp_reward_to_time = $('#tmp_toTime').val();
    var tmp_reward_from_time = $('#tmp_fromTime').val();
    var tmp_reward_to_data = $('#tmp_toDate').val();
    var tmp_reward_from_data = $("#tmp_fromDate").val();

    if(tmp_reward_content != '' && tmp_reward_content != null){

        $('#form_has_data').val('1');
    }
    if(tmp_reward_point_rate != '' && tmp_reward_point_rate != null){
        $('#form_has_data').val('1');
    }
    if(tmp_reward_point != '' && tmp_reward_point != null){
        $('#form_has_data').val('1');
    }
    if(tmp_discount_price != '' && tmp_discount_price != null){
        $('#form_has_data').val('1');
    }
    if(tmp_discount_rate != '' && tmp_discount_rate != null){
        $('#form_has_data').val('1');
    }
    if(tmp_applied_lowest_price != '' && tmp_applied_lowest_price != null){
        $('#form_has_data').val('1');
    }
    if(tmp_reward_to_time != '' && tmp_reward_to_time != null){
        $('#form_has_data').val('1');
    }
    if(tmp_reward_from_time != '' && tmp_reward_from_time != null){
        $('#form_has_data').val('1');
    }
    if(tmp_reward_to_data != '' && tmp_reward_to_data != null){
        $('#form_has_data').val('1');
    }
    if(tmp_reward_from_data != '' && tmp_reward_from_data != null){
        $('#form_has_data').val('1');
    }

    renametmpInput();
}

renametmpInput();
function renametmpInput(){
    if($('#form_has_data').val() == '0'){
        $('#tmp_fromDate').attr('name','tmp_reward_from_data_not_validate');
        $('#tmp_toDate').attr('name','tmp_reward_to_data_not_validate');
        $('#tmp_fromTime').attr('name','tmp_reward_from_time_not_validate');
        $('#tmp_toTime').attr('name','tmp_reward_to_time_not_validate');
        $('#tmp_Tel').attr('name','tmp_applied_lowest_price_not_validate');
        $('#tmp_discount_price').attr('name','tmp_discount_price_not_validate');
        $('#tmp_discount_rate').attr('name','tmp_discount_rate_not_validate');
        $('#tmp_reward_point').attr('name','tmp_reward_point_not_validate');
        $('#tmp_reward_point_rate').attr('name','tmp_reward_point_rate_not_validate');
        $('#tmp_reward_content').attr('name','tmp_reward_content_not_validate');    

        $(".form-support2").find("input,select").removeClass('error');
        $(".form-support2").find("label,error").hide();
    }else{
        $('#tmp_fromDate').attr('name','tmp_reward_from_data');
        $('#tmp_toDate').attr('name','tmp_reward_to_data');
        $('#tmp_fromTime').attr('name','tmp_reward_from_time');
        $('#tmp_toTime').attr('name','tmp_reward_to_time');
        $('#tmp_Tel').attr('name','tmp_applied_lowest_price');
        $('#tmp_discount_price').attr('name','tmp_discount_price');
        $('#tmp_discount_rate').attr('name','tmp_discount_rate');
        $('#tmp_reward_point').attr('name','tmp_reward_point');
        $('#tmp_reward_point_rate').attr('name','tmp_reward_point_rate');
        $('#tmp_reward_content').attr('name','tmp_reward_content');  
    }
}

function checkValueSupport1(){
    var reward_content = $('#reward_content').val();

    var reward_point_rate = $('#reward_point_rate').val();
    var reward_point = $('#reward_point').val();

    var discount_price = $('#discount_price').val();
    var discount_rate = $('#discount_rate').val();

    var applied_lowest_price = $('#lowest_price').val();
    var to_time = $('#toTime').val();
    var from_time = $('#fromTime').val();
    var to_data = $('#toDate').val();
    var from_data = $("#fromDate").val();

    if(reward_content != '' && reward_content != null){
        return false;
    }
    if(reward_point_rate != '' && reward_point_rate != null){
        return false;
    }
    if(reward_point != '' && reward_point != null){
        return false;
    }
    if(discount_price != '' && discount_price != null){
        return false;
    }
    if(discount_rate != '' && discount_rate != null){
        return false;
    }
    if(applied_lowest_price != '' && applied_lowest_price != null){
        return false;
    }
    if(to_time != '' && to_time != null){
        return false;
    }
    if(from_time != '' && from_time != null){
        return false;
    }
    if(to_data != '' && to_data != null){
        return false;
    }
    if(from_data != '' && from_data != null){
        return false;
    }

    return true;
}

function renameSupport1(){
    if(checkValueSupport1()){
        $('#fromDate').attr('name','reward_from_data_not_validate');
        $('#toDate').attr('name','reward_to_data_not_validate');
        $('#fromTime').attr('name','reward_from_time_not_validate');
        $('#toTime').attr('name','reward_to_time_not_validate');
        $('#lowest_price').attr('name','applied_lowest_price_not_validate');
        $('#discount_price').attr('name','discount_price_not_validate');
        $('#discount_rate').attr('name','discount_rate_not_validate');
        $('#reward_point').attr('name','reward_point_not_validate');
        $('#reward_point_rate').attr('name','reward_point_rate_not_validate');
        $('#reward_content').attr('name','reward_content_not_validate');
    }
      
}

function restoreSupport1(){
    $('#fromDate').attr('name','reward_from_data');
    $('#toDate').attr('name','reward_to_data');
    $('#fromTime').attr('name','reward_from_time');
    $('#toTime').attr('name','reward_to_time');
    $('#lowest_price').attr('name','applied_lowest_price');
    $('#discount_price').attr('name','discount_price');
    $('#discount_rate').attr('name','discount_rate');
    $('#reward_point').attr('name','reward_point');
    $('#reward_point_rate').attr('name','reward_point_rate');
    $('#reward_content').attr('name','reward_content');  
}