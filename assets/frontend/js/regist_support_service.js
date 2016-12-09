// Validation form regist support service
$(document).ready(function() {
    // Only input number at price and point
    $('input[type="tel"]').on('input',function(event){
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    $('#form_regist_support').validate({
        rules: {
            introduce_uid: {
                required: true,
                maxlength: 12
            },
            buy_price: {
                required: true,
                number: true,
                maxlength: 9,
                min: 1
            },
            point: {
                number: true,
                maxlength: 9,
                min: 0
            },
            password_point: {
                maxlength: 20
            }
        },
        messages: {
            introduce_uid: {
                required: "会員IDまたは紹介者会員IDを入力してください。",
                maxlength: "紹介者IDは12文字以内で入力してください。"
            },
            buy_price: {
                required: "購入金額を入力してください。",
                number: "購入金額を正しく入力してください。",
                maxlength: "購入金額は9文字以内で入力してください。",
                min : "購入金額を正しく入力してください。"
            },
            point: {
                number: "使用ポイントを正しく入力してください。",
                maxlength: "使用ポイントは9文字以内で入力してください。",
                min : "使用ポイントを正しく入力してください。"
            },
            password_point: {
                maxlength: "ポイントパスワードは20文字以内で入力してください。"
            }
        },
        errorPlacement: function(error, element) {
            switch (element.attr("name")){
                case "introduce_uid":
                    error.insertAfter("#introduce_uid");
                    break;
                case "buy_price":
                    error.insertAfter("#buy_price");
                    break;
                case "point":
                    error.insertAfter("#point");
                    break;
                case "password_point":
                    error.insertAfter("#password_point");
                    break;
                default:
                    error.insertAfter(element);
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

});