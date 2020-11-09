$(document).ready(function () {
    const message = {
        "desired_option_1": {
            require_from_group: $('.text-error-desired').val(),
        },
        "desired_content": {
            required: $('.text-error-desired-content').val(),
        }
    };

    const message_payment_method = $('.text-error-pay-method').val();

    jQuery.validator.addMethod("less_than", function (value, element, param) {
        return parseInt(value) <= parseInt($('#' + param).val());
    }, message_payment_method);


    $('#form-setting-detail').validate({
        ignore: "",
        rules: {
            "desired_option_1": {
                require_from_group: [1, ".desired-group"]
            },
            "desired_option_2": {
                require_from_group: [1, ".desired-group"]
            },
            "desired_option_3": {
                require_from_group: [1, ".desired-group"]
            },
            "desired_option_4": {
                require_from_group: [1, ".desired-group"]
            },
            "desired_option_5": {
                require_from_group: [1, ".desired-group"]
            },
            "desired_content": {
                required: true,
            },
            total_offer: {
                less_than: function (element) {
                    if (typeof $('input[name="payment_method"]:checked').val() === 'undefined') {
                        return "total_amount";
                    }
                }

            },
        },
        errorPlacement: function (error, element) {
            let name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },
        showErrors: function (errorMap, errorList) {
            if (typeof errorList[0] != "undefined") {
                let test = $(errorList[0].element);
                if(test.attr('id') === 'total_offer'){
                   let position = $('#total_offer_validate').position().top;
                    $('html, body').animate({
                        scrollTop: position
                    });
                }
            }
            this.defaultShowErrors(); // keep error messages next to each input element
        },
        messages: message,
    });

    let formatDatetime = 'Y-m-d H:i';

    $('#desired_option01, #desired_option02, #desired_option03, #desired_option04, #desired_option05').datetimepicker({
        format: formatDatetime,
        step: 30,
        minDate: 0
    });

    $('input[type="submit"]').prop('disabled', false);
    $('input[name="payment_method"]').click(function () {
        let radio = $(this);
        if (radio.data('waschecked') === true) {
            radio.prop('checked', false);
            radio.data('waschecked', false);
            $('.message-paypal').addClass('d-none')
        } else {
            if(parseInt($(this).val()) === 2) {
                $('.message-paypal').removeClass('d-none')
            }else{
                $('.message-paypal').addClass('d-none')
            }
            radio.data('waschecked', true);
            $('#total_offer-error').remove();
        }
        radio.siblings('input[name="payment_method"]').data('waschecked', false);
    });

    $('#submit-detail').on('click', function () {
        if ($("#form-setting-detail").valid()) {
            $('#form-setting-detail').submit();
            $(':input[type="submit"]').prop('disabled', true);
        }
    });

    $('#button-payment').on('click', function () {
        let payment = $("input[name='payment_method']:checked").val();
        if (parseInt(payment) === 1) {
            setTimeout(function () {
                $('#bankInformation').modal('show');
            }, 500)
            $('#paymentModal').modal('hide');
        }else {
            $('#paymentModal').modal('hide');
        }
    });

});
