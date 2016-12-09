$(document).ready(function() {
    $.validator.addMethod("not_allow_2byte", function(value) {
        //regEx = '/[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ０-９]+[々〆〤]+/u';
        regEx = /[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[ａ-ｚＡ-Ｚ０-９]+[々〆〤]+/;
        if(regEx.test(value))
            return false;
        else if(!regEx.test(value))
            return true;
    }, '「半角英数字記号」8文字以上を入力してください。');

    //custom method password
    $.validator.addMethod("password_val", function(value) {
        //regEx = '/[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ０-９]+[々〆〤]+/u';
        regEx = /[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z]+|[ａ-ｚＡ-Ｚ]+[々〆〤]+/;
        regEx_2 = /[0-9]|[０-９]+/;

        if(regEx_2.test(value) && regEx.test(value)){
            return true;
        }

        return false;
    }, '「半角英数字記号」8文字以上を入力してください。');

    $('#form_login').validate({
        rules: {
            id: {
                required: true,
            },
            password: {
              required: true,
              not_allow_2byte: true,
              maxlength: 50
              //password_val:true,
              //minlength: 8
            }
        },
        messages: {
            id: {
                required: "IDを入力してください。",
            },
            password: {
              required: "PASSを入力してください。",
              maxlength: "PASSは50文字以内で入力してください。"
              //password_val:"PASS「半角英数字記号」8文字以上を入力して下さい",
              //minlength: "半角英数字記号8文字以上。"
            }
        },
        focusInvalid: false,
        invalidHandler: function(form, validator) {
            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top
            }, 1000);
            $('.tr-error').hide();

            if (!validator.numberOfInvalids())
                return;
        }
    });
});