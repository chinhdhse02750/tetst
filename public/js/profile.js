$(document).ready(function () {
    const message = {
        "password": {
            required: "Vui lòng nhập mật khẩu.",
            minlength: "Vui lòng nhập ít nhất 8 ký tự chữ hoặc số.",
        },
        "confirm_password": {
            required : 'Vui lòng nhập mật khẩu xác nhận.',
            equalTo: "Mật khẩu xác nhận không trùng khớp.",
            minlength: "Vui lòng nhập ít nhất 8 ký tự chữ hoặc số.",
        }
    };
    $('#member-form').validate({
        rules: {
            "password": {
                required: true,
                minlength: 8,
                maxlength: 50
            },
            "confirm_password": {
                required: true,
                equalTo: "#password",
                minlength: 8,
                maxlength: 50
            }
        },
        messages: message,
    });

    $('#btn-change-password').on('click', function () {
        if($("#member-form").valid()){
            $('#confirm-change-password').modal('show');
        }
    });

    $('#button-change-password').on('click', function() {
        $('#member-form').submit();
    });

    $('#btn-change-profile').on('click', function () {
        let phone = $(".phone").val();
        let address = $(".address").val();
        let facebook = $(".facebook").val();
        let postcode = $(".postcode").val();
        let pref_id = $(".pref_id").val();
        let time_shipping = $(".time_shipping").val();
        let url = $('#url-change-profile').val();
        let formData = new FormData();
        formData.append('phone', phone);
        formData.append('address', address);
        formData.append('facebook', facebook);
        formData.append('postcode', postcode);
        formData.append('pref_id', pref_id);
        formData.append('time_shipping', time_shipping);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status === true) {
                    $('#edit-profile-success').modal('show');
                }
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });
    });

});


