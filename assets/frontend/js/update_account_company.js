// Validation form update infor company
$(document).ready(function() {
    // Only input number at tel and post code
    $('input[type="tel"]').on('input',function(event){
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    // Validate format password
    $.validator.addMethod("password_val", function(value) {
        if(value.length > 0) {
            return /[a-z]/.test(value) // has a lowercase letter
            && /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
            && /[0-9]/.test(value); // has a digit
        }
        return true;
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

    // Validate length exactly length of post code
    $.validator.addMethod("exactlength", function(value, element, param) {
                return this.optional(element) || value.length == param;
        },"郵便番号は7文字です。（例：000-0000）");

    // Validion white space (fullsize and halfsize)
    $.validator.addMethod("noSpace", function(value, element) { 
          return this.optional(element) || /^\S+$/i.test(value);
        });

    $('#form_regist').validate({
        groups: {
            post_code: "post_code_1 post_code_2",
            tel: "tel_1 tel_2 tel_3",
            rep_tel: "rep_tel_1 rep_tel_2 rep_tel_3"
            
        },
        rules: {
            name: {
                required: true,
                maxlength: 50,
                noSpace: true
            },
            post_code_1: {
                required: true,
                number: true,
                maxlength: 3,
                exactlength: 3
            },
            post_code_2: {
                required: true,
                number: true,
                maxlength: 4,
                exactlength: 4
            },
            prefecture_id: {
                required: true,
                maxlength: 2
            },
            city: {
                required: true,
                maxlength: 30,
                noSpace: true
            },
            street_address: {
                required: true,
                maxlength: 100,
                noSpace: true
            },
            station: {
                maxlength: 100,
                noSpace: true
            },
            tel_1: {
                required: true,
                number: true,
                maxlength: 5
            },
            tel_2: {
                required: true,
                number: true,
                maxlength: 5
            },
            tel_3: {
                required: true,
                number: true,
                maxlength: 5
            },
            outside_url: {
                url: true,
                maxlength: 255
            },
            public_relations: {
                maxlength: 1000
            },
            representative: {
                required: true,
                maxlength: 50,
                noSpace: true
            },
            rep_tel_1: {
                required: true,
                number: true,
                maxlength: 5
            },
            rep_tel_2: {
                required: true,
                number: true,
                maxlength: 5
            },
            rep_tel_3: {
                required: true,
                number: true,
                maxlength: 5
            },
            rep_address: {
                required: true,
                maxlength: 255,
                email: true,
                noSpace: true
            },
            introduce_uid: {
                required: true,
                maxlength: 12
            },
            category_id: {
                required: true,
                number: true,
                maxlength: 50
            },
            bank_name: {
                required: true,
                maxlength: 50,
                noSpace: true
            },
            bank_branch_number: {
                required: true,
                number: true,
                maxlength: 50
            },
            bank_type: {
                required: true,
                maxlength: 20
            },
            bank_number: {
                required: true,
                maxlength: 20
            },
            bank_holder: {
                required: true,
                maxlength: 50,
                noSpace: true
            }    
        },
        messages: {
            name: {
                required: "企業名を入力してください。",
                maxlength: "企業名は50文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"
            },
            post_code_1: {
                required: "郵便番号を入力してください。",
                number: "郵便番号を正しく入力してください。",
                maxlength: "郵便番号は3文字以内で入力してください。"
            },
            post_code_2: {
                required: "郵便番号を入力してください。",
                number: "郵便番号を正しく入力してください。",
                maxlength: "郵便番号は4文字以内で入力してください。"
            },
            prefecture_id: {
                required: "都道府県を入力してください。",
                maxlength: "都道府県は2文字以内で入力してください。"
            },
            city: {
                required: "市区町村を入力してください。",
                maxlength: "市区町村は30文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"
            },
            street_address: {
                required: "番地以降を入力してください。",
                maxlength: "番地以降は100文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"
            },
            station: {
                maxlength: "最寄駅は100文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"
            },
            tel_1: {
                required: "企業連絡先を入力してください。",
                number: "企業連絡先を正しく入力してください。",
                maxlength: "企業連絡先は15文字以内で入力してください。"
            },
            tel_2: {
                required: "企業連絡先を入力してください。",
                number: "企業連絡先を正しく入力してください。",
                maxlength: "企業連絡先は15文字以内で入力してください。"
            },
            tel_3: {
                required: "企業連絡先を入力してください。",
                number: "企業連絡先を正しく入力してください。",
                maxlength: "企業連絡先は15文字以内で入力してください。"
            },
            outside_url: {
                url: "URLを正しく入力してください。",
                maxlength: "URLは255文字以内で入力してください。"
            },
            public_relations: {
                maxlength: "U会社PRは1000文字以内で入力してください。"
            },
            representative: {
                required: "担当者名を入力してください。",
                maxlength: "担当者名は50文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"
            },
            rep_tel_1: {
                required: "担当者連絡先を入力してください。",
                number: "担当者連絡先を正しく入力してください。",
                maxlength: "担当者連絡先は15文字以内で入力してください。"
            },
            rep_tel_2: {
                required: "担当者連絡先を入力してください。",
                number: "担当者連絡先を正しく入力してください。",
                maxlength: "担当者連絡先は15文字以内で入力してください。"
            },
            rep_tel_3: {
                required: "担当者連絡先を入力してください。",
                number: "担当者連絡先を正しく入力してください。",
                maxlength: "担当者連絡先は15文字以内で入力してください。"
            },
            rep_address: {
                required: "担当者メールアドレスを入力してください。",        
                maxlength : "担当者メールアドレスは255文字以内で入力してください。",
                email: '担当者メールアドレスを正しく入力してください。',
                noSpace: "空白文字またはスペースは利用できません"
            },
            introduce_uid: {
                required: "企業紹介者IDを入力してください。",
                maxlength : "企業紹介者IDは12文字以内で入力してください。"                   
            },
            category_id: {
                required: "カテゴリを入力してください。",  
                maxlength : "カテゴリは50文字以内で入力してください。",   
                number: "カテゴリを正しく入力してください。",               
            },
            bank_name: {
                required: "金融機関名を入力してください。",  
                maxlength : "金融機関名は50文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"       
            },
            bank_branch_number: {
                required: "店番号を入力してください。",  
                maxlength : "店番号は50文字以内で入力してください。",   
                number: "店番号を正しく入力してください。",               
            },
            bank_number: {
                required: "口座番号を入力してください。",  
                maxlength : "口座番号は20文字以内で入力してください。",                 
            },
            bank_holder: {
                required: "口座名義人を入力してください。",  
                maxlength : "口座名義人は50文字以内で入力してください。",
                noSpace: "空白文字またはスペースは利用できません"               
            }
        },
        errorPlacement: function(error, element) {
            switch (element.attr("name")){
                case "name":
                    error.insertAfter("#name");
                    break;
                case "post_code":
                    error.insertAfter("#post_code");
                    break;
                case "prefecture_id":
                    error.insertAfter("#prefecture_id");
                    break;
                case "city":
                    error.insertAfter("#city");
                    break;
                case "street_address":
                    error.insertAfter("#street_address");
                    break;
                case "station":
                    error.insertAfter("#station");
                    break;
                case "tel":
                    error.insertAfter("#tel");
                    break;
                case "outside_url":
                    error.insertAfter("#outside_url");
                    break;
                case "public_relations":
                    error.insertAfter("#public_relations");
                    break;
                case "representative":
                    error.insertAfter("#representative");
                    break;
                case "rep_tel":
                    error.insertAfter("#rep_tel");
                    break;
                case "rep_address":
                    error.insertAfter("#rep_address");
                    break;
                case "introduce_uid":
                    error.insertAfter("#introduce_uid");
                    break;
                case "category_id":
                    error.insertAfter("#category_id");
                    break;
                case "bank_name":
                    error.insertAfter("#bank_name");
                    break;
                case "bank_branch_number":
                    error.insertAfter("#bank_branch_number");
                    break;
                case "bank_type":
                    error.insertAfter("#bank_type");
                    break;
                case "bank_number":
                    error.insertAfter("#bank_number");
                    break;
                case "bank_holder":
                    error.insertAfter("#bank_holder");
                    break;
                default:
                    error.insertAfter(element);
            }
        },
        focusInvalid: false,
        invalidHandler: function(form, validator) {
            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);

            if (!validator.numberOfInvalids())
                return;
        }
    });

});