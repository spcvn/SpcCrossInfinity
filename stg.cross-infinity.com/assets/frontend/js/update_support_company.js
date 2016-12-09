$(document).ready(function() {
     jQuery.extend(jQuery.validator.messages, {
        date: "日付を正しく入力してください。（例：1990/01/01）",
    });
    /*
    		$.validator.addMethod("check", function(value, element) {
      			if($("#discount_price").val() && $("#discount_rate").val() || (!$("#discount_price").val() && !$("#discount_rate").val())){
      				return false;
      			} else{
      				return true;
      			}			
    		});
    		$.validator.addMethod("point", function(value,element) {
            if($("#reward_point_rate").val() && $("#reward_point").val() || (!$("#reward_point_rate").val() && !$("#reward_point").val())){
      				return false;
      			} else{
      				return true;
      			}		
        	});
    */

    function timeCompare(time1, time2) {
        var t1 = new Date();
        var parts = time1.split(":");
        t1.setHours(parts[0], parts[1], 0);
        var t2 = new Date();
        parts = time2.split(":");
        t2.setHours(parts[0], parts[1], 0);
        if (t1.getTime() > t2.getTime()) return 1;
        if (t1.getTime() < t2.getTime()) return -1;
        return 0;
    }

    function have_day(fromday, today) {
        if (fromday == today || today == "") {
            return 1;
        } else {
            return 0;
        }
    }

    // Phuc add new validate
    $.validator.addMethod("greaterThanToday", function(value, element) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            // $("#fromDate").focus();
            // $("#toDate").focus();
            // $("#fromDate").focus();
            if($('#active_flag').val() == '1'){
                    return true;
                }
            if (new Date(value) >= new Date()) {
                return true;
            } else {
                //    $("#fromDate").focus();
                // $("#toDate").focus();
                if($('#active_flag').val() == '1'){
                	return true;
                }

                return false;
            }
        } else {
            return true;
        }
    }, '日付現在の日付よりも小さい入力しないでください。');

    $.validator.addMethod("time24", function(value, element) {
        if (value == null || value == '') {
            return true;
        }

        if (!/^\d{2}:\d{2}$/.test(value)) return false;
        var parts = value.split(':');
        if (parts[0] > 23 || parts[1] > 59) return false;
        return true;
    }, "時間を正しく入力してください。 （例：00:00）。");
    // End Phuc

    $.validator.addMethod("not_allow_japanese_chars", function(value) {
        //regEx = '/[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ０-９]+[々〆〤]+/u';
        regEx = /[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[ａ-ｚＡ-Ｚ０-９]+|[々〆〤]+/;
        if (regEx.test(value))
            return false;
        else if (!regEx.test(value))
            return true;
    }, '「半角英数字記号」8文字以上を入力してください。');

    $.validator.addMethod("not_equalTo_password", function(value, element) {
        return $('#password_login').val() != $('#password_reward').val()
    });

    $.validator.addMethod("check", function(value, element) {
        if ($("#discount_price").val() && $("#discount_rate").val() || (!$("#discount_price").val() && !$("#discount_rate").val())) {
            // Add class error for all
            $("#discount_price").addClass('error');
            $("#discount_rate").addClass('error');

            return false;
        } else {
            // Remove class error for all
            $("#discount_price").removeClass('error');
            $("#discount_rate").removeClass('error');

            return true;
        }
    });

    $.validator.addMethod("point", function(value, element) {
        if ($("#reward_point_rate").val() && $("#reward_point").val() || (!$("#reward_point_rate").val() && !$("#reward_point").val())) {
            // Add class error for all
            $("#reward_point_rate").addClass('error');
            $("#reward_point").addClass('error');

            return false;
        } else {

            // Remove class error for all
            $("#reward_point_rate").removeClass('error');
            $("#reward_point").removeClass('error');

            return true;
        }
    });

    $.validator.addMethod("greaterThan", function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value)) && $(params).val() != "") {
            // $("#fromDate").focus();
            // $("#toDate").focus();
            // $("#fromDate").focus();
            if (new Date(value) >= new Date($(params).val())) {
                return true;
            } else {
                $("#fromDate").focus();
                $("#toDate").focus();
                return false;
            }
        } else {
            return true;
        }
    }, '応援対象年月日Toは応援対象年月日Fromよりも後の日付を指定してください。');

    $.validator.addMethod("leastThan", function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value)) && $(params).val() != "") {
            return new Date(value) <= new Date($(params).val());

        } else {

            return true;
        }
    }, '応援対象年月日Fromは応援対象年月日Toよりも前の日付を指定してください。');

    //compare time
    $.validator.addMethod("compareTimeTo", function(value, element, params) {
        if ($("#fromTime").val() != "" && $(params).val() != "") {

            if (have_day($("#fromDate").val(), $("#toDate").val()) == 1) {

                if (timeCompare($(params).val(), value) == 1) {
                    return true;
                } else {
                    return false;
                }

            } else {
                return true;
            }

        } else {
            return true;
        }

    }, '応援対象時間Fromは応援対象時間Toよりも前の時間を指定してください。');

    $.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    }, "郵便番号は7文字です。（例：000-0000）");


    $.validator.addMethod("check_group", function(value) {
        // if(isNaN(value)){
        return value == 1;
    }, '現在は通常応援以外は選択できません。');


    $.validator.addMethod("password_val", function(value) {
        // if(isNaN(value)){
        return /[a-z]/.test(value) // has a lowercase letter
            && /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value) && /[0-9]/.test(value); // has a digit
        // }
        return true;
    }, '「半角英数字記号」8文字以上を入力してください。');

    // $.validator.addMethod("password_val", function(value) {
    //    // if(isNaN(value)){
    //    return /[a-z]/.test(value) // has a lowercase letter
    //        && /[0-9]/.test(value); // has a digit
    //    // }
    //    return true;
    // });

    // Validate input date (mm/dd/yyyy or mm-dd-yyyy)
    $.validator.addMethod("custom_date", function(value) {
        //return /\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/.test(value);
        //return /[0-1]\d\/[0-3]\d\/\d{4}/.test(value);

        empty = /^\s*$/;

        date1 = /^(0[1-9]|[1-9]|1[0-2])\/(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])\/(19|20)\d{2}$/; // mm/dd/yyyy
        date2 = /^(19|20)\d{2}\/(0[1-9]|[1-9]|1[0-2])\/(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])$/; // yyyy/mm/dd

        date3 = /^(0[1-9]|1[0-2]|[1-9])-(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])-(19|20)\d{2}$/; // mm-dd-yyyy
        date4 = /^(19|20)\d{2}-(0[1-9]|1[0-2]|[1-9])-(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])$/; // yy-mm-dd
        // if(empty.test(str)){
        // 	return true;
        // }
        if (value == null || value == '') {
            return true;
        } else {
            if (date1.test(value) || date2.test(value) || date3.test(value) || date4.test(value)) {
                return true;
            }
        }
        return false;

        //return /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/.test(value);

    }, '日付を正しく入力してください。（例：1990/01/01）');

    //validate time 
    $.validator.addMethod("custom_time", function(value) {
        times = /^(0[0-9]|[0-9]|1[0-9]|2[0-3]):(0[0-9]|[0-9]|[0-5][0-9])$/;
        if (value == null || value == '') {
            return true;
        } else {
            if (times.test(value)) {
                return true;
            }
        }
        return false;
    }, '日付を正しく入力してください。（例：00:00）');

    //compare time
    $.validator.addMethod("compareTime", function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }
        if (have_day($("#fromDate").val(), $("#toDate").val()) == 1) {
            if (Number(value != 0)) {
                if (timeCompare(value, $(params).val()) == 1) {
                    return true;
                } else {
                    $("#fromTime").focus();
                    $("#toTime").focus();
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    }, '応援対象時間Toは応援対象時間Fromよりも後の時間を指定してください。');

    // Validion white space (fullsize and halfsize)
    $.validator.addMethod("noSpace", function(value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    });

    // Validate for TMP
    $.validator.addMethod("tmp_check", function(value, element) {
        if ($("#tmp_discount_price").val() && $("#tmp_discount_rate").val() || (!$("#tmp_discount_price").val() && !$("#tmp_discount_rate").val())) {
            // Add class error for all
            $("#tmp_discount_price").addClass('error');
            $("#tmp_discount_rate").addClass('error');

            return false;
        } else {
            // Remove class error for all
            $("#tmp_discount_price").removeClass('error');
            $("#tmp_discount_rate").removeClass('error');

            return true;
        }
    });

    $.validator.addMethod("tmp_point", function(value, element) {
        if ($("#tmp_reward_point_rate").val() && $("#tmp_reward_point").val() || (!$("#tmp_reward_point_rate").val() && !$("#tmp_reward_point").val())) {
            // Add class error for all
            $("#tmp_reward_point_rate").addClass('error');
            $("#tmp_reward_point").addClass('error');

            return false;
        } else {

            // Remove class error for all
            $("#tmp_reward_point_rate").removeClass('error');
            $("#tmp_reward_point").removeClass('error');

            return true;
        }
    });

    $.validator.addMethod("tmp_greaterThan", function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value)) && $(params).val() != "") {
            if (new Date(value) >= new Date($(params).val())) {
                //$("#tmp_fromDate").focus();
                //$("#tmp_toDate").focus();
                //$(".btn_submit").focus();
                $("#tmp_fromDate-error").hide();
                $("#tmp_fromDate").removeClass("error");
                return true;
            } else {
                $("#tmp_fromDate").focus();
                $("#tmp_toDate").focus();
                return false;
            }
        } else {
            return true;
        }
    }, '応援対象年月日Toは応援対象年月日Fromよりも後の日付を指定してください。');

    $.validator.addMethod("tmp_leastThan", function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value)) && $(params).val() != "") {
            return new Date(value) <= new Date($(params).val());

        } else {

            return true;
        }
    }, '応援対象年月日Fromは応援対象年月日Toよりも前の日付を指定してください。');

    //compare time
    $.validator.addMethod("tmp_compareTimeTo", function(value, element, params) {
        if ($("#tmp_fromTime").val() != "" && $(params).val() != "") {

            if (have_day($("#tmp_fromDate").val(), $("#tmp_toDate").val()) == 1) {

                if (timeCompare($(params).val(), value) == 1) {
                    return true;
                } else {
                    return false;
                }

            } else {
                return true;
            }

        } else {
            return true;
        }

    }, '応援対象時間Fromは応援対象時間Toよりも前の時間を指定してください。');

    $.validator.addMethod("tmp_compareTime",function(value, element, params) {
	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) > new Date($(params).val());
	    }
	    if(have_day($("#tmp_fromDate").val(),$("#tmp_toDate").val()) == 1 ){
			if(Number(value != 0)){
				if(timeCompare(value,$(params).val()) == 1){
					return true;
				}else{
					$("#tmp_fromTime").focus();
		    		$("#tmp_toTime").focus();
					return false;
				}
			}else{
				return true;
			}
		}else{
			return true;
		}
	},'応援対象時間Toは応援対象時間Fromよりも後の時間を指定してください。');

    $.validator.addMethod("tmp_compare10Days",function(value, element) {
    	if (!/Invalid|NaN/.test(new Date(value))) {
            // $("#fromDate").focus();
            // $("#toDate").focus();
            // $("#fromDate").focus();
            if (new Date(value) >= new Date().getTime() + (10 * 24 * 60 * 60 * 1000)) {
                return true;
            } else {
                //    $("#fromDate").focus();
                // $("#toDate").focus();
                return false;
            }
        } else {
            return true;
        }
	},'新規応援条件は本日から10日後の日付から指定可能です。');


    $.validator.addMethod("tmp_comparewithToDate",function(value, element) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            if($('#toDate').val() == '' || $('#toDate').val() == ''){
                return true;
            }
            return (new Date(value) > new Date($('#toDate').val()));
        } else {
            return true;
        }
    },'新規応援条件の応援対象年月日Fromは、既存の応援対象年月日Fromよりも後の日付を入力してください。');

    // END VALIDATE TMP

    // Update spec 2016-1-16

    // Validate format password
    $.validator.addMethod("password_val", function(value) {
        if(value.length > 0) {
            return /[a-z]/.test(value) // has a lowercase letter
            && /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
            && /[0-9]/.test(value); // has a digit
        }
        return true;
    });

    // Validion white space (fullsize and halfsize)
    $.validator.addMethod("noSpace", function(value, element) { 
          return this.optional(element) || /^\S+$/i.test(value);
        });

    // Validate not allow japanese character 
    $.validator.addMethod("not_allow_japanese_chars", function(value) {
        if(value.length > 0) {
            regEx = /[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[ａ-ｚＡ-Ｚ０-９]+|[々〆〤]+/;
            if(regEx.test(value))
                return false;
            else if(!regEx.test(value))
                return true;
        }
        return true;
        
    });

    

    // validate signup form on keyup and submit
    $("#editForm1").validate({
        groups: {
            post_code: "post_code_1 post_code_2",
            rep_tel: "rep_tel_1 rep_tel_2 rep_tel_3",
            discount: "discount_price discount_rate",
            reward: "reward_point reward_point_rate",
            tel_num: "tel_1 tel_2 tel_3",

            tmp_discount: "tmp_discount_price tmp_discount_rate",
            tmp_reward: "tmp_reward_point tmp_reward_point_rate",
        },
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case "discount_rate":
                    error.insertAfter("#discount");
                    break;
                case "discount_price":
                    error.insertAfter("#discount");
                    break;
                case "reward_point":
                    error.insertAfter("#reward");
                    break;
                case "reward_point_rate":
                    error.insertAfter("#reward");
                    break;
                default:
                    error.insertAfter(element);
            }
        },
        ignore: "",
        rules: {
            // Update spec
            mail: {
                required: true,
                email: true,
                maxlength: 255,
                noSpace: true
            },
            password_login: {
                minlength: 8,
                maxlength: 50,
                password_val: true,
                not_allow_japanese_chars: true,
                noSpace: true
            },
            password_reward: {
                minlength: 8,
                maxlength: 50,
                password_val: true,
                not_allow_japanese_chars: true,
                noSpace: true
            },

            reward_group: {
                required: true,
                maxlength: 2,
                number: true,
                check_group: true
            },
            reward_from_data: {
                required: true,
                //date: true,
                custom_date: true,
                leastThan: "#toDate",
                // Phuc add
                greaterThanToday: true
            },
            reward_to_data: {
                greaterThan: "#fromDate",
                //date: true,
                custom_date: true,

                // Phuc add
                greaterThanToday: true
            },
            reward_from_time: {
                required: true,
                maxlength: 5,
                custom_time: true,
                compareTimeTo: "#toTime",
                time24: true,
            },
            reward_to_time: {
                custom_time: true,
                compareTime: "#fromTime",
                //required: true,   
                //maxlength : 5 
                time24: true,
            },
            applied_lowest_price: {
                required: true,
                maxlength: 9,
                number: true
            },
            discount_price: {
                maxlength: 9,
                number: true,
                check: true
            },
            discount_rate: {
                maxlength: 5,
                number: true,
                check: true,
            },
            reward_point: {
                maxlength: 9,
                number: true,
                point: true
            },
            reward_point_rate: {
                maxlength: 5,
                number: true,
                point: true
            },
            reward_content: {
                required: true,
                maxlength: 2000,
            },

            // FOR SUPPORT 2 VALIDATE
            tmp_reward_group: {
                required: true,
                maxlength: 2,
                number: true,
                check_group: true
            },
            tmp_reward_from_data: {
                required: true,
                //date: true,
                custom_date: true,
                leastThan: "#tmp_toDate",
                // Phuc add
                greaterThanToday: true,
                tmp_compare10Days: true,
                tmp_comparewithToDate: true
            },
            tmp_reward_to_data: {
                tmp_greaterThan: "#tmp_fromDate",
                //date: true,
                custom_date: true,

                // Phuc add
                greaterThanToday: true
            },
            tmp_reward_from_time: {
                required: true,
                maxlength: 5,
                custom_time: true,
                tmp_compareTimeTo: "#tmp_toTime",
                time24: true,
            },
            tmp_reward_to_time: {
                custom_time: true,
                tmp_compareTime: "#tmp_fromTime",
                //required: true,   
                //maxlength : 5 
                time24: true,
            },
            tmp_applied_lowest_price: {
                required: true,
                maxlength: 9,
                number: true
            },
            tmp_discount_price: {
                maxlength: 9,
                number: true,
                tmp_check: true
            },
            tmp_discount_rate: {
                maxlength: 5,
                number: true,
                tmp_check: true,
            },
            tmp_reward_point: {
                maxlength: 9,
                number: true,
                tmp_point: true
            },
            tmp_reward_point_rate: {
                maxlength: 5,
                number: true,
                tmp_point: true
            },
            tmp_reward_content: {
                required: true,
                maxlength: 2000,
            },

        },
        messages: {
            // Update spec
            mail: {
                required: "メールアドレスを入力してください。",
                email: "メールアドレスを正しく入力してください。",
                maxlength: "メールアドレスは255文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"
            },
            password_login: {
                minlength : "ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
                maxlength : "ログインパスワードは50文字以内で入力してください。",
                password_val: "ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
                not_allow_japanese_chars: "ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
                noSpace: "空白文字またはスペースは利用できません"             
            },
            password_reward: {
                minlength : "企業情報変更パスワードは「半角英数字記号」8文字以上を入力してください。",
                maxlength : "企業情報変更パスワードは50文字以内で入力してください。",
                password_val: "企業情報変更パスワードは「半角英数字記号」8文字以上を入力してください。",
                not_allow_japanese_chars: "企業情報変更パスワードは「半角英数字記号」8文字以上を入力してください。",
                noSpace: "空白文字またはスペースは利用できません"         
            },

            tmp_reward_group_hidden: {
                required: "応援区分を入力してください。",
            },

            reward_group: {
                required: "現在は通常応援以外は選択できません。",
                maxlength: "は5文字以内で入力してください。",
                number: "を正しく入力してください。",
            },
            reward_from_data: {
                required: "応援対象年月日Fromを入力してください。",
                // Phuc add
                greaterThanToday: "応援対象年月日Fromは今日以降を入力してください。"
            },
            reward_to_data: {
                //required: "応援対象年月日Toを入力してください。",      
            },
            reward_from_time: {
                required: "応援対象時間Fromを入力してください。",
                maxlength: "応援対象時間Fromは5文字以内で入力してください。",
            },
            reward_to_time: {
                //required: "応援対象時間Toを入力してください。", 
                //maxlength : "Max length is 5 chars",
            },
            applied_lowest_price: {
                required: "応援適用最低金額を入力してください。",
                maxlength: "応援適用最低金額は9文字以内で入力してください。",
                number: "応援適用最低金額を正しく入力してください。",
            },
            discount_price: {
                maxlength: "購入者割引9文字以内で入力してください。",
                number: "購入者割引を正しく入力してください",
                check: '購入者割引は「円」か「％」のいずれかを入力してください。'
            },
            discount_rate: {
                maxlength: "購入者割引5文字以内で入力してください。",
                number: "購入者割引を正しく入力してください",
                check: '購入者割引は「円」か「％」のいずれかを入力してください。'
            },
            reward_point: {
                maxlength: "販売促進費9文字以内で入力してください。",
                number: "販売促進費を正しく入力してください",
                point: '販売促進費は「円」か「％」のいずれかを入力してください。'
            },
            reward_point_rate: {
                maxlength: "販売促進費5文字以内で入力してください。",
                number: "販売促進費を正しく入力してください",
                point: '販売促進費は「円」か「％」のいずれかを入力してください。'
            },
            reward_content: {
                required: "応援内容説明を入力してください。",
                maxlength: "応援内容説明は2,000文字以内で入力してください。",
            },

            // FOR SUPPORT 2 VALIDATE

            tmp_reward_group: {
                required: "現在は通常応援以外は選択できません。",
                maxlength: "は5文字以内で入力してください。",
                number: "を正しく入力してください。",
            },
            tmp_reward_from_data: {
                required: "応援対象年月日Fromを入力してください。",
                // Phuc add
                greaterThanToday: "応援対象年月日Fromは今日以降を入力してください。"
            },
            tmp_reward_to_data: {
                //required: "応援対象年月日Toを入力してください。",      
            },
            tmp_reward_from_time: {
                required: "応援対象時間Fromを入力してください。",
                maxlength: "応援対象時間Fromは5文字以内で入力してください。",
            },
            tmp_reward_to_time: {
                //required: "応援対象時間Toを入力してください。", 
                //maxlength : "Max length is 5 chars",
            },
            tmp_applied_lowest_price: {
                required: "応援適用最低金額を入力してください。",
                maxlength: "応援適用最低金額は9文字以内で入力してください。",
                number: "応援適用最低金額を正しく入力してください。",
            },
            tmp_discount_price: {
                maxlength: "購入者割引9文字以内で入力してください。",
                number: "購入者割引を正しく入力してください",
                tmp_check: '購入者割引は「円」か「％」のいずれかを入力してください。'
            },
            tmp_discount_rate: {
                maxlength: "購入者割引5文字以内で入力してください。",
                number: "購入者割引を正しく入力してください",
                tmp_check: '購入者割引は「円」か「％」のいずれかを入力してください。'
            },
            tmp_reward_point: {
                maxlength: "販売促進費9文字以内で入力してください。",
                number: "販売促進費を正しく入力してください",
                tmp_point: '販売促進費は「円」か「％」のいずれかを入力してください。'
            },
            tmp_reward_point_rate: {
                maxlength: "販売促進費5文字以内で入力してください。",
                number: "販売促進費を正しく入力してください",
                tmp_point: '販売促進費は「円」か「％」のいずれかを入力してください。'
            },
            tmp_reward_content: {
                required: "応援内容説明を入力してください。",
                maxlength: "応援内容説明は2,000文字以内で入力してください。",
            }
        }
    });

    function checkHiddenPHPError(){
        $("label.error").each(function(index, value) { 
            var parent = $(this).parent().find('.php-error').hide();
        });
    }
});
