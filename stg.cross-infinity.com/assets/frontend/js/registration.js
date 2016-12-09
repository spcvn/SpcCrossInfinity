//validation form update infor user
$(document).ready(function() {

    //custom method password
    $.validator.addMethod("password_val", function(value) {
        // if(isNaN(value)){
        return /[a-z]/.test(value) // has a lowercase letter
            && /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
            && /[0-9]/.test(value); // has a digit
        // }
        return true;
    });

    $.validator.addMethod("not_allow_japanese_chars", function(value) {
        //regEx = '/[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ０-９]+[々〆〤]+/u';
        regEx = /[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[ａ-ｚＡ-Ｚ０-９]+|[々〆〤]+/;
        if(regEx.test(value))
            return false;
        else if(!regEx.test(value))
            return true;
    });

    //custom method password point and password login
    $.validator.addMethod("not_equalTo_password", function(value,element) {
        return $('#password_login').val() != $('#password_point').val()
    });

        // Update custom check email
    $.validator.addMethod("email_update", function(value, element) {
        return /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
    });

    // validion white space
   $.validator.addMethod("noSpace", function(value, element) { 
	  return this.optional(element) || /^\S+$/i.test(value);
	});

    $('#form_registration').validate({
        groups: {
            post_code: "post_code_left post_code_right",
            tel: "tel_left tel_center tel_right",
            company_tel: "company_tel_left company_tel_center company_tel_right"
        },
        rules: {
            name: {
                required: true,
                maxlength:50,
                noSpace:true
            },
            name_kana:{
                required:true,
                maxlength:100,
                noSpace:true
            },
            post_code_left: {
                required:true,
                number:true,
                rangelength:[3,3],
                maxlength:3
            },
            post_code_right: {
                required:true,
                number:true,
                rangelength:[4,4],
                maxlength:4
            },
            city:{
                required:true,
                maxlength:30,
                noSpace:true
            },
            tel_left: {
                required:true,
                number:true,
                maxlength:5
            },
            tel_center: {
                required:true,
                number:true,
                maxlength:5
            },
            tel_right: {
                required:true,
                number:true,
                maxlength:5
            },
            mail:{
                required:true,
                email:true,
                email_update:true,
                maxlength:50,
                noSpace:true
            },
            introducer_uid:{
                maxlength:12,
                noSpace:true
            },
            company_tel_left: {
                number:true,
                maxlength:5
            },
            company_tel_center: {
                number:true,
                maxlength:5
            },
            company_tel_right: {
                number:true,
                maxlength:5
            },
            password_point: {
              password_val:true,
              minlength:8,
              not_equalTo_password:true,
              not_allow_japanese_chars:true,
              maxlength:50
            },
            password_login: {
              password_val:true,
              minlength:8,
              not_equalTo_password:true,
              not_allow_japanese_chars:true,
              maxlength:50
            },
            prefecture:{
                required:true
            },
            accept:{
                required:true
            },
            company_name:{
                maxlength:50,
                noSpace:true
            },
            company_address:{
                maxlength:255,
                noSpace:true
            }
        },
        messages: {
            name: {
                required: "会員名を入力してください。",
                maxlength:"会員名は50文字以内で入力してください。",
                noSpace:"空白文字またはスペースは利用できません。"
            },
            name_kana:{
                required: "ふりがなを入力してください。",
                maxlength:"ふりがなは100文字以内で入力してください。",
                noSpace:"空白文字またはスペースは利用できません。"
            },
            post_code_left: {
              required: "郵便番号を入力してください。",  
              number:"郵便番号を入力してください。",
              rangelength: "郵便番号は7文字です。（例：000-0000）",
              maxlength:"郵便番号は3文字以内で入力してください。",
            },
            post_code_right: {
              required: "郵便番号を入力してください。",  
              number:"郵便番号を入力してください。",
              rangelength: "郵便番号は7文字です。（例：000-0000）",
              maxlength:"郵便番号は4文字以内で入力してください。",
            },
            city: {
                required:"市区町村を入力してください。",
                maxlength:"市区町村は30文字以内で入力してください。",
                noSpace:"空白文字またはスペースは利用できません。"
            },
            tel_left: { 
              required:"連絡先を入力してください。",
              number:"連絡先を入力してください。",
              maxlength: "連絡先は15文字以内で入力してください。",
            },
            tel_center: {
                required:"連絡先を入力してください。",
                number:"連絡先を入力してください。",
                maxlength: "連絡先は15文字以内で入力してください。",
            },
            tel_right: {
              required:"連絡先を入力してください。",
              number:"連絡先を入力してください。",
              maxlength: "連絡先は15文字以内で入力してください。",
            },
            mail: {
                required: "メールアドレスを入力してください。",
                email: "メールアドレスを正しく入力してください。（例：aaaa@aaa.com）",
                email_update: "メールアドレスを正しく入力してください。（例：aaaa@aaa.com）",
                maxlength:"メールアドレスは50文字以内で入力してください。",
                noSpace:"空白文字またはスペースは利用できません。"
            },
            introducer_uid:{
                maxlength:"半角英数字記号12文字以上。",
                noSpace:"空白文字またはスペースは利用できません。"
            },
            company_tel_left: {  
              number:"法人連絡先を入力してください。",
              maxlength: "法人連絡先は15文字以内で入力してください。",
              required:"法人連絡先を入力してください。",
            },
            company_tel_center: {  
              number:"法人連絡先を入力してください。",
              maxlength: "法人連絡先は15文字以内で入力してください。",
              required:"法人連絡先を入力してください。",
            },
            company_tel_right: { 
              number:"法人連絡先を入力してください。",
              maxlength: "法人連絡先は15文字以内で入力してください。",
              required:"法人連絡先を入力してください。",
            },
            password_point: {
              required: "ポイント使用パスワードを入力してください。", 
              password_val:"ポイント使用パスワードは「半角英数字記号」8文字以上を入力してください。",
              minlength:"ポイント使用パスワードは「半角英数字記号」8文字以上を入力してください。",
              not_equalTo_password:"ポイント使用パスワードとログインパスワードは同じものを使用出来ません。",
              not_allow_japanese_chars:"ポイント使用パスワードは「半角英数字記号」8文字以上を入力してください。",
              maxlength:"ポイント使用パスワードは50文字以内で入力してください。"
            },
            password_login: {
              required: "ログインパスワードを入力してください。",
              password_val:"ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
              minlength:"ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
              not_equalTo_password:"ポイント使用パスワードとログインパスワードは同じものを使用出来ません。",
              not_allow_japanese_chars:"ログインパスワードは「半角英数字記号」8文字以上を入力してください。",
              maxlength:"ログインパスワードは50文字以内で入力してください。",
            },
            prefecture:{
                required:"都道府県を入力してください。"
            },
            accept:{
                required:"利用規約への同意は必須です。"
            },
            company_name:{
                maxlength:"法人名は50文字以内で入力してください。",
                noSpace:"空白文字またはスペースは利用できません。"
            },
            company_address:{
                maxlength:"法人住所は255文字以内で入力してください。",
                noSpace:"空白文字またはスペースは利用できません。"
            }
        },
        errorPlacement: function(error, element) {
            switch (element.attr("name")){
                case "post_code":
                    error.insertAfter("#post_code");
                    break;
                case "tel_left":
                    error.insertAfter("#tel_left");
                    break;
                case "tel_center":
                    error.insertAfter("#tel_center");
                    break;
                case "tel_right":
                    error.insertAfter("#tel_right");
                    break;
                case "company_tel_left":
                    error.insertAfter("#company_tel_left");
                    break;
                case "company_tel_center":
                    error.insertAfter("#company_tel_center");
                    break;
                case "company_tel_right":
                    error.insertAfter("#company_tel_right");
                    break;
                case "accept":
                    error.insertAfter("#accept-messege");
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


    //choose ”ええい” no submit
    var error = $('body').find('.error');
    $.each(error,function(key,value){
        if($(value).text()!=''){
            $('html, body').animate({
                scrollTop: $('.error').eq(key).offset().top
            }, 1000);
            return false ;
        }
    })
    // $("input[type='checkbox'][name='accept']").change(function() {
    //         if(this.checked) {
    //             $('label[for=accept]').remove();
    //         } else {
    //             $("#accept-messege").append('<label id="accept-error" class="error" for="accept">利用規約への同意は必須です。</label>');                
    //             $('html, body').animate({
    //                 scrollTop: $('#accept-error').offset().top
    //             }, 1000);
    //         }
    // });

    //check password point and password login not requried => not min length
    $('#update').click(function() {
        var password_point_edit = $("#password_point").prop('required');
        var password_point = $("#password_point").val();
        var password_login_edit = $("#password_login").prop('required');
        var password_login = $("#password_login").val();
        if(password_point_edit == false && password_point == ""){
                $("#password_point").rules( "remove", "minlength password_val not_equalTo_password" );
        }
        if(password_login_edit == false && password_login == ""){
                $("#password_login").rules( "remove", "minlength password_val not_equalTo_password" );
        }

        //check tel and company_tel enter full 3 textbox
        var company_tel_left = $("input[type='tel'][name='company_tel_left']");
        var company_tel_center = $("input[type='tel'][name='company_tel_center']");
        var company_tel_right = $("input[type='tel'][name='company_tel_right']");
        if(company_tel_right.val().length > 0 || company_tel_center.val().length > 0 || company_tel_left.val().length > 0 ){
            $(company_tel_left).rules( "add", "required" );
            $(company_tel_center).rules( "add", "required" );
            $(company_tel_right).rules( "add", "required" );
        }
        else{
            $(company_tel_left).rules( "remove", "required" );
            $(company_tel_center).rules( "remove", "required" );
            $(company_tel_right).rules( "remove", "required" );   
        }
    });

    $('#registration').click(function() {
        //check tel and company_tel enter full 3 textbox
        var company_tel_left = $("input[type='tel'][name='company_tel_left']");
        var company_tel_center = $("input[type='tel'][name='company_tel_center']");
        var company_tel_right = $("input[type='tel'][name='company_tel_right']");
        if(company_tel_right.val().length > 0 || company_tel_center.val().length > 0 || company_tel_left.val().length > 0 ){
            $(company_tel_left).rules( "add", "required" );
            $(company_tel_center).rules( "add", "required" );
            $(company_tel_right).rules( "add", "required" );
        }
    });

    //validition enter number
    $('input[type="tel"]').on('input',function(event){
        this.value = this.value.replace(/[^0-9]/g,'');
      });
    
});
//check 2 byte
// 呼び出し
$(function() {
    // 諸事情でinputにdata属性がつけれないことを考慮した書き方
    $('.fhconvert').each(function() {
        var $this = $(this);
        //inputの場合はそのままフォーカスアウトに指定する
        if($this[0].tagName === 'INPUT') {
            $this.focusout(function() {
                $(this).fhconvert();
            });
        } else {
            //inputでない場合は、inputにデータ属性をコピーする
            $input = $this.find('input');
            $input.data('fhconvert', $this.data('fhconvert'));
            
            $input.focusout(function() {
                $(this).fhconvert();
            });
        }
    });
});

//定義
(function($) {
    $.fn.fhconvert = function() {
        var defaultOption = {'jaCode':true, 'space':true, 'convSet':'object'};

        $(this).each(function() {
            var $this = $(this);
            var dataAttr = $this.data('fhconvert');

            var converter = function(data) {
                var fhconvertType, settings;
                if(typeof(data) === 'string') {
                    //文字列のみでタイプを指定されている場合はそのまま
                    fhconvertType = data;
                    settings = defaultOption;
                } else if(typeof(data) === 'object') {
                    //オプション付きで指定されている場合は、optionをextend
                    fhconvertType = data.type;
                    settings = $.extend(defaultOption, data.option);
                }
                // hfconvertに渡す
                $this.val(FHConvert[fhconvertType]($this.val(), settings));
            };

            //dataAttrが見つからない場合は抜ける
            if(typeof(dataAttr) === 'undefined') {
                return true;    
            }

            if(Object.prototype.toString.call(dataAttr) !== "[object Array]") {
                converter(dataAttr);
            } else {
                for(var i = 0, l = dataAttr.length; i < l; i++) {
                    converter(dataAttr[i]);
                }
            }

        });
        return this;
    };
}(jQuery));