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

    // Update custom check email
    $.validator.addMethod("email_update", function(value, element) {
        return /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
    });

    //custom method password point and password login
    $.validator.addMethod("confirm_password", function(value,element) {
        return $('#password').val() == $('#confirm_password').val()
    });
    $.validator.addMethod("confirm_password_reward", function(value,element) {
        return $('#password_reward').val() == $('#confirm_password_reward').val()
    });

    $.validator.addMethod("not_allow_japanese_chars", function(value) {
        //regEx = '/[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ０-９]+[々〆〤]+/u';
        regEx = /[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[ａ-ｚＡ-Ｚ０-９]+|[々〆〤]+/;
        if(regEx.test(value))
            return false;
        else if(!regEx.test(value))
            return true;
    });

    $('#form_reset_password').validate({
        rules: {
           email:{
                required:true,
                email_update:true,
                email:true,
                maxlength:255
            }
        },
        messages: {
            email: {
                required: "メールアドレスを入力してください。",
                email: "メールアドレスを正しく入力してください。（例：aaaa@aaa.com）",
                email_update: "メールアドレスを正しく入力してください。（例：aaaa@aaa.com）",
                maxlength:'メールアドレスは255文字以内で入力してください。'
            }
        },
        focusInvalid: false,
        invalidHandler: function(form, validator) {
            $('.error-controller').hide();
            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);

            if (!validator.numberOfInvalids())
                return;
        }
    });

    $('#form_new_password').validate({
        rules: {
            password: {
              required:true,
              password_val:true,
              minlength:8,
              maxlength:50,
              not_allow_japanese_chars: true
            },
            confirm_password: {
              required:true,
              password_val:true,
              minlength:8,
              maxlength:50,
              confirm_password:true,
              not_allow_japanese_chars: true
            },
            password_reward: {
              required:true,
              password_val:true,
              minlength:8,
              maxlength:50,
              not_allow_japanese_chars: true
            },
            confirm_password_reward: {
              required:true,
              password_val:true,
              minlength:8,
              maxlength:50,
              confirm_password_reward:true,
              not_allow_japanese_chars: true
            }
        },
        messages: {
            password: {
              required: "新しいログインPASSを入力してください。", 
              minlength:"新しいログインPASSは8文字以上を入力してください。",
              maxlength:"新しいログインPASSは50文字以内で入力してください。",
              password_val:"新しいログインPASSは「半角英数字記号」8文字以上を入力してください。",
              not_allow_japanese_chars:"新しいログインPASSは「半角英数字記号」8文字以上を入力してください。"
            },
            confirm_password: {
              required: "ログインPASSの再入力を入力してください。",
              minlength:"ログインPASSの再入力は8文字以上を入力してください。",
              maxlength:"ログインPASSの再入力は50文字以内で入力してください。",
              confirm_password:"「新しいログインPASS」と「ログインPASSの再入力」が一致しません。",
              password_val:"ログインPASSの再入力は「半角英数字記号」8文字以上を入力してください。",
              not_allow_japanese_chars:"ログインPASSの再入力は「半角英数字記号」8文字以上を入力してください。"
            },
            password_reward: {
              required: "新しい企業情報変更PASSを入力してください。", 
              minlength:"新しい企業情報変更PASSは8文字以上を入力してください。",
              maxlength:"新しい企業情報変更PASSは50文字以内で入力してください。",
              password_val:"新しい企業情報変更PASSは「半角英数字記号」8文字以上を入力してください。",
              not_allow_japanese_chars:"新しい企業情報変更PASSは「半角英数字記号」8文字以上を入力してください。"
            },
            confirm_password_reward: {
              required: "企業情報変更PASSの再入力を入力してください。",
              minlength:"企業情報変更PASSの再入力は8文字以上を入力してください。",
              maxlength:"企業情報変更PASSの再入力は50文字以内で入力してください。",
              confirm_password_reward:"「新しい企業情報変更PASS」と「企業情報変更PASSの再入力」が一致しません。",
              password_val:"企業情報変更PASSの再入力は「半角英数字記号」8文字以上を入力してください。",
              not_allow_japanese_chars:"企業情報変更PASSの再入力は「半角英数字記号」8文字以上を入力してください。"
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