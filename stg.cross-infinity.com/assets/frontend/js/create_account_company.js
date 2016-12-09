$().ready(function() {
		function timeCompare(time1,time2) {
		  var t1 = new Date();
		  var parts = time1.split(":");
		  t1.setHours(parts[0],parts[1],0);
		  var t2 = new Date();
		  parts = time2.split(":");
		  t2.setHours(parts[0],parts[1],0);
		  if (t1.getTime()>t2.getTime()) return 1;
		  if (t1.getTime()<t2.getTime()) return -1;
		  return 0;
		}

		function have_day(fromday,today){
			if(fromday == today || today == ""){
				return 1;
			}else{
				return 0;
			}
		}

		// Phuc add new validate
		$.validator.addMethod("greaterThanToday",function(value, element) {
		    if (!/Invalid|NaN/.test(new Date(value))) {
		    	// $("#fromDate").focus();
		    	// $("#toDate").focus();
		    	// $("#fromDate").focus();
		        if (new Date(value) >= new Date()){
		        	return true;
		        }else{
			     //    $("#fromDate").focus();
			    	// $("#toDate").focus();
		        	return false;
		        }
		    }else{
		    	return true;
			}
		},'日付現在の日付よりも小さい入力しないでください。');

		$.validator.addMethod("time24", function(value, element) {
			if(value == null || value == ''){
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
        if(regEx.test(value))
            return false;
        else if(!regEx.test(value))
            return true;
    	}, '「半角英数字記号」8文字以上を入力してください。');

		$.validator.addMethod("not_equalTo_password", function(value,element) {
	        return $('#password_login').val() != $('#password_reward').val()
	    });

		$.validator.addMethod("check", function(value, element) {
  			if($("#discount_price").val() && $("#discount_rate").val() || (!$("#discount_price").val() && !$("#discount_rate").val())){
  				// Add class error for all
  				$("#discount_price").addClass('error');
  				$("#discount_rate").addClass('error');

  				return false;
  			} else{
  				// Remove class error for all
  				$("#discount_price").removeClass('error');
  				$("#discount_rate").removeClass('error');

  				return true;
  			}			
		});

		$.validator.addMethod("point", function(value,element) {
	        if($("#reward_point_rate").val() && $("#reward_point").val() || (!$("#reward_point_rate").val() && !$("#reward_point").val())){
		        	// Add class error for all
	  				$("#reward_point_rate").addClass('error');
	  				$("#reward_point").addClass('error');

	  				return false;
	  			} else{

	  				// Remove class error for all
	  				$("#reward_point_rate").removeClass('error');
	  				$("#reward_point").removeClass('error');

	  				return true;
	  			}		
	    });

		$.validator.addMethod("greaterThan",function(value, element, params) {
		    if (!/Invalid|NaN/.test(new Date(value)) && $(params).val() != "") {
		    	// $("#fromDate").focus();
		    	// $("#toDate").focus();
		    	// $("#fromDate").focus();
		        if (new Date(value) > new Date($(params).val())){
		        	return true;
		        }else{
			        $("#fromDate").focus();
			    	$("#toDate").focus();
		        	return false;
		        }
		    }else{
		    	return true;
		}
		},'応援対象年月日Toは応援対象年月日Fromよりも後の日付を指定してください。');

		$.validator.addMethod("leastThan",function(value, element, params) {
		    if (!/Invalid|NaN/.test(new Date(value)) && $(params).val() != "") {
		        return new Date(value) < new Date($(params).val());

		    }else{
		    	
		    	return true;
		}
		},'応援対象年月日Fromは応援対象年月日Toよりも前の日付を指定してください。');

		//compare time
		$.validator.addMethod("compareTimeTo",function(value, element, params) {
		 if ($("#fromTime").val() != "" && $(params).val() != "") 
		 {
			    
			    if(have_day($("#fromDate").val(),$("#toDate").val()) == 1 ){
						
						if(timeCompare($(params).val(),value) == 1){
							return true;
						}else{
							return false;
						}
					
				}else{
					return true;
				}
		
		}else{
			 return true;
		}

		},'応援対象時間Fromは応援対象時間Toよりも前の時間を指定してください。');

		$.validator.addMethod("exactlength", function(value, element, param) {
 				return this.optional(element) || value.length == param;
		},"郵便番号は7文字です。（例：000-0000）");


    	$.validator.addMethod("check_group", function(value) {
        // if(isNaN(value)){
        return value == 1;
    	},'現在は通常応援以外は選択できません。');
		

    	$.validator.addMethod("password_val", function(value) {
	        // if(isNaN(value)){
	        return /[a-z]/.test(value) // has a lowercase letter
	            && /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
	            && /[0-9]/.test(value); // has a digit
	        // }
	        return true;
	    },'「半角英数字記号」8文字以上を入力してください。');

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
			if(value == null || value == ''){
				return true;
			}else{
				if(date1.test(value) || date2.test(value) || date3.test(value) || date4.test(value)){
		        	return true;
		        }
			}
	        return false;

			//return /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/.test(value);
			
		},'日付を正しく入力してください。（例：1990/01/01）');

		//validate time 
		$.validator.addMethod("custom_time", function(value) {
			times = /^(0[0-9]|[0-9]|1[0-9]|2[0-3]):(0[0-9]|[0-9]|[0-5][0-9])$/;
			if(value == null || value == ''){
				return true;
			}else{
				if(times.test(value)){
		        	return true;
		        }
			}
	        return false;
		},'日付を正しく入力してください。（例：00:00）');

		//compare time
		$.validator.addMethod("compareTime",function(value, element, params) {

		    if (!/Invalid|NaN/.test(new Date(value))) {
		        return new Date(value) > new Date($(params).val());
		    }
		    if(have_day($("#fromDate").val(),$("#toDate").val()) == 1 ){
				if(Number(value != 0)){
					if(timeCompare(value,$(params).val()) == 1){
						return true;
					}else{
						$("#fromTime").focus();
			    		$("#toTime").focus();
						return false;
					}
				}else{
					return true;
				}
			}else{
				return true;
			}
		},'応援対象時間Toは応援対象時間Fromよりも後の時間を指定してください。');

		// Validion white space (fullsize and halfsize)
	    $.validator.addMethod("noSpace", function(value, element) { 
		  return this.optional(element) || /^\S+$/i.test(value);
		});

		// validate signup form on keyup and submit
		$("#signupForm1").validate({
			groups: {
			post_code: "post_code_1 post_code_2",
            rep_tel: "rep_tel_1 rep_tel_2 rep_tel_3"   ,
            discount : "discount_price discount_rate" ,
            reward : "reward_point reward_point_rate" ,
            tel_num : "tel_1 tel_2 tel_3",      	    
        },
			  errorPlacement: function(error, element) {
			  	switch (element.attr("name")){
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
	                case "rep_tel_1":
	                    error.insertAfter("#rep_tel");
	                    break;
                    case "rep_tel_2":
	                    error.insertAfter("#rep_tel");
	                    break;
                    case "rep_tel_3":
	                    error.insertAfter("#rep_tel");
	                    break;
	                case "bank_name":
	                    error.insertAfter("#bank_name");
	                    break; 
	                case "agree":
	                    error.insertAfter("#agree");
	                    break;
	                case "tel_1":
	                    error.insertAfter("#tel-num");
	                    break;
	                case "tel_2":
	                    error.insertAfter("#tel-num");
	                    break;  
	                case "tel_3":
	                    error.insertAfter("#tel-num");
	                    break;
	                case "post_code_1":
	                    error.insertAfter("#post-code");
	                    break;  
	                case "post_code_2":
	                    error.insertAfter("#post-code");
	                    break;      
	                default:
	                    error.insertAfter(element);
	            }
			},
			ignore: "",
			rules: {
				// lastname: "required",
				name: {
					required: true,
					maxlength : 50,
					noSpace: true
				},
				post_code_1: {
					required: true,
					maxlength : 3,
					exactlength : 3	
				},
				post_code_2
				: {
					required: true,
					maxlength : 4,
					exactlength : 4	
				},
				prefecture_id: {
					required: true,
					maxlength : 2,
					number:true
				},
				city: {
					required: true,
					maxlength : 30,
					noSpace: true
				},
				street_address: {
					required: true,
					maxlength : 100,
					noSpace: true
				},
				station: {
					maxlength : 100,
					noSpace: true					
				},
				tel_1: {
					required: true,	
					maxlength : 5,
					//exactlength : 4				
				},
				tel_2: {
					required: true,	
					maxlength : 5,
					//exactlength : 4						
				},
				tel_3: {
					required: true,	
					maxlength : 5,
					//exactlength : 4						
				},
				mail: {
					required: true,	
					email: true,
					maxlength : 255,
					noSpace: true					
				},
				outside_url: {
					maxlength : 255,
					url: true						
				},
				public_relations: {
					maxlength : 1000,				
				},
				representative: {
					required: true,	
					maxlength : 50,	
					noSpace: true				
				},
				rep_tel_1: {
					required: true,
					maxlength : 5,
					number:true,
					//exactlength : 4				
				},
				rep_tel_2: {
					required: true,	
					maxlength : 5,
					number:true,
					//exactlength : 4				
				},
				rep_tel_3: {
					required: true,		
					maxlength : 5,
					number:true,
					//exactlength : 4			
				},
				rep_address: {
					required: true,		
					maxlength : 255,
					email: true,
					noSpace: true			
				},
				introduce_uid: {
					required: true,	
					maxlength : 12,			
				},
				category_id: {
					required: true,	
					maxlength : 50,	
					number:true,				
				},
				bank_name: {
					required: true,
					maxlength : 50,
					noSpace: true						
				},
				bank_branch_number: {
					required: true,	
					maxlength : 50,
					number:true				
				},
				// bank_type: {
				// 	required: true,
				// 	maxlength : 20,						
				// },
				bank_number: {
					required: true,
					maxlength : 20,	
					number:true						
				},
				bank_holder: {
					required: true,
					maxlength : 50,
					noSpace: true						
				},
				password_login: {
					required: true,	
					maxlength : 50,
					minlength : 8,
					not_equalTo_password:true,
					password_val : true,
					not_allow_japanese_chars : true,
					noSpace: true			
				},
				password_reward: {
					required: true,	
					maxlength : 50,
					minlength : 8,
					not_equalTo_password:true,
					password_val : true,
					not_allow_japanese_chars : true,
					noSpace: true				
				},
				reward_group: {
					required: true,	
					maxlength : 2,
					number:true,
					check_group : true				
				},
				reward_from_data: {
					required: true,
					//date: true,
					custom_date: true,
					leastThan : "#toDate",
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
					maxlength : 5,
					custom_time : true,
					compareTimeTo: "#toTime",	
					time24: true,			
				},
				reward_to_time: {
					custom_time : true,
					compareTime: "#fromTime",	
					//required: true,	
					//maxlength : 5	
					time24: true,			
				},
				applied_lowest_price: {
					required: true,	
					maxlength : 9,
					number:true				
				},
				discount_price: {
					maxlength : 9,
					number:true,
					check:true					
				},
				discount_rate: {	
					maxlength : 5,
					number:true,
					check:true,
				},
				reward_point: {
					maxlength : 9,
					number:true,
					point :true				
				},
				reward_point_rate: {	
					maxlength : 5,
					number:true,
					point :true						
				},
				reward_content: {
					required: true,
					maxlength : 2000,					
				},
				agree: {
				required: true,
				},
			},
			 invalidHandler: function(event, validator) {
			 		$('.error-controller').hide();
					var errors = validator.numberOfInvalids();
					if (errors) {
						$('#checkbox').attr('checked', false);
						$("#agree").html('');
					}
				  },
			messages: {
				name: {
					required: "企業名を入力してください。",
					maxlength : "企業名は50文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"
				},
				post_code_1: {
					required: "郵便番号を入力してください。",
					maxlength : "郵便番号は3文字以内で入力してください。",
				},
				post_code_2
				: {
					required: "郵便番号を入力してください。",
					maxlength : "郵便番号は4文字以内で入力してください。s",	
				},
				prefecture_id: {
					required: "都道府県を入力してください。",
					maxlength : "Max length is 2 chars",	
					number:"都道府県を正しく入力してください。"
				},
				city: {
					required: "市区町村を入力してください。",
					maxlength : "市区町村は30文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"

				},
				street_address: {
					required: "番地以降を入力してください。",
					maxlength : "番地以降は100文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"	
				},
				station: {
					maxlength : "最寄駅は100文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"							
				},
				tel_1: {
					required: "企業連絡先を入力してください。",	
					maxlength : "企業連絡先は15文字以内で入力してください。",					
				},
				tel_2: {
					required: "企業連絡先を入力してください。",	
					maxlength : "企業連絡先は15文字以内で入力してください。",						
				},
				tel_3: {
					required: "企業連絡先を入力してください。",	
					maxlength : "企業連絡先は15文字以内で入力してください。",					
				},
				mail: {
					required: "メールアドレスを入力してください。",	
					email: "メールアドレスを正しく入力してください。",
					maxlength : "メールアドレスは255文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"				
				},
				outside_url: {
					maxlength : "URLは255文字以内で入力してください。",
					url: "URLを正しく入力してください。"						
				},
				public_relations: {
					maxlength : "会社PRは1,000文字以内で入力してください。",	
				},
				representative: {
					required: "担当者名を入力してください。",	
					maxlength : "担当者名は50文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"	
				},
				rep_tel_1: {
					required: "担当者連絡先を入力してください。",
					maxlength : "担当者連絡先は15文字以内で入力してください。",	
					number:"担当者連絡先を正しく入力してください。",					
				},
				rep_tel_2: {
					required: "担当者連絡先を入力してください。",	
					maxlength : "担当者連絡先は15文字以内で入力してください。",	
					number:"担当者連絡先を正しく入力してください。",				
				},
				rep_tel_3: {
					required: "担当者連絡先を入力してください。",		
					maxlength : "担当者連絡先は15文字以内で入力してください。",	
					number:"担当者連絡先を正しく入力してください。",			
				},
				rep_address: {
					required: "担当者メールアドレス 入力してください。",		
					maxlength : "担当者メールアドレスは255文字以内で入力してください。",
					email: "担当者メールアドレスを正しく入力してください。",
					noSpace: "空白文字またはスペースは利用できません"	
				},
				introduce_uid: {
					required: "企業紹介者IDを入力してください。",	
					maxlength : "企業紹介者IDは12文字以内で入力してください。",				
				},
				category_id: {
					required: "カテゴリを選択してください。",	
					maxlength : "Max length is 50 chars",	
					number:"Please input number",				
				},
				bank_name: {
					required: "金融機関名を入力してください。",
					maxlength : "金融機関名は50文字以内で入力してください。",	
					noSpace: "空白文字またはスペースは利用できません"									
				},
				bank_branch_number: {
					required: "店番号を入力してください。",
					maxlength : "店番号は50文字以内で入力してください。",
					number : "店番号を正しく入力してください。"					
				},
				// bank_type: {
				// 	required: "口座番号を入力してください。",
				// 	maxlength : "口座番号20文字以内で入力してください。",					
				// },
				bank_number: {
					required: "口座番号を入力してください。",
					maxlength : "口座番号は20文字以内で入力してください。",
					number:"口座番号を正しく入力してください。"					
				},
				bank_holder: {
					required: "口座名義人を入力してください。",
					maxlength : "口座名義人は50文字以内で入力してください。",
					noSpace: "空白文字またはスペースは利用できません"
				},
				password_login: {
					required: "ログインパスワードを入力してください。",	
					maxlength : "ログインパスワードは50文字以内で入力してください。",
					minlength:"ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
					not_equalTo_password:"ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。",
					password_val : "ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
					not_allow_japanese_chars : "ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
					noSpace: "空白文字またはスペースは利用できません"
				},
				password_reward: {
					required: "企業情報変更パスワードを入力してください。",
					maxlength : "企業情報変更パスワードは50文字以内で入力してください。",
					minlength:"企業情報変更パスワードは「半角英数字記号」8文字以上を入力してください。",
					not_equalTo_password:"ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。",
					password_val : "企業情報変更パスワードは「半角英数字記号」8文字以上を入力してください。",
					not_allow_japanese_chars : "企業情報変更パスワードは「半角英数字記号」8文字以上を入力してください。",
					noSpace: "空白文字またはスペースは利用できません"
				},
				reward_group: {
					required: "現在は通常応援以外は選択できません。",	
					maxlength : "Max length is 5 chars",
					number:"Please input number !",				
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
					maxlength : "応援対象時間Fromは5文字以内で入力してください。",
				},
				reward_to_time: {
					//required: "応援対象時間Toを入力して下さい",	
					//maxlength : "Max length is 5 chars",
				},
				applied_lowest_price: {
					required: "応援適用最低金額を入力してください。",	
					maxlength : "応援適用最低金額は9文字以内で入力してください。",
					number:"応援適用最低金額を正しく入力してください。",				
				},
				discount_price: {
					maxlength : "購入者割引9文字以内で入力してください。",
					number:"購入者割引を正しく入力してください",	
					check : '購入者割引は「円」か「％」のいずれかを入力してください。'			
				},
				discount_rate: {
					maxlength : "購入者割引5文字以内で入力してください。",
					number:"購入者割引を正しく入力してください",
					check : '購入者割引は「円」か「％」のいずれかを入力してください。'	
				},
				reward_point: {
					maxlength : "販売促進費9文字以内で入力してください。",
					number:"販売促進費を正しく入力してください",
					point : '販売促進費は「円」か「％」のいずれかを入力してください。'
				},
				reward_point_rate: {	
					maxlength : "販売促進費5文字以内で入力してください。",
					number:"販売促進費を正しく入力してください",
					point : '販売促進費は「円」か「％」のいずれかを入力してください。'
				},
				reward_content: {
					required: "応援内容説明を入力してください。",
					maxlength : "応援内容説明は2,000文字以内で入力してください。",					
				},
				agree: {
					required: "利用規約への同意は必須です。",
				},
			}
		});

	jQuery.extend(jQuery.validator.messages, {
		date: "日付を正しく入力してください。（例：1990/01/01）",
	});
		// jQuery.validator.addMethod("check", function(value, element) {
  // 			if($("#discount_price").val() && $("#discount_rate").val() || (!$("#discount_price").val() && !$("#discount_rate").val())){
  // 				return false;
  // 			} else{
  // 				return true;
  // 			}			
		// }, '購入者割引は「円」か「％」のいずれかを入力してください。');
		// jQuery.validator.addMethod("point", function(value, element) {
  // 			if($("#reward_point_rate").val() && $("#reward_point").val() || (!$("#reward_point_rate").val() && !$("#reward_point").val())){
  // 				return false;
  // 			} else{
  // 				return true;
  // 			}			
		// }, '販売促進費は「円」か「％」のいずれかを入力してください。');  		
	});
