$(document).ready(function () {
    const message = {
        "password": {
            required: "パスワードを入力してください。",
            minlength: "8文字以上の半角英数字にて入力してください。",
        },
        "confirm_password": {
            required : '確認の為、パスワードを入力してください。',
            equalTo: "もう一度、パスワードをお確かめください。",
            minlength: "8文字以上の半角英数字にて入力してください。",
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
        messages: (locate === 'jp') ? message : 'default',
    });

    $('#btn-change-password').on('click', function () {
        if($("#member-form").valid()){
            $('#confirm-change-password').modal('show');
        }
    });

    $('#confirm-change-password').on('click', function() {
        $('#member-form').submit();
    });

    $('#btn-change-profile').on('click', function () {
        let receipt = $("input[type='radio'][name='receipt_type']:checked").val()
        let url = $('#url-change-profile').val();
        let formData = new FormData();
        formData.append('receipt_type', receipt);
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


