$(document).ready(function () {
    $('.btn-request-setting').on('click', function () {
        let url = $('#url-request-setting').val();
        $.ajax({
            async: false,
            type: 'GET',
            url: url,
            processData: true,
            contentType: true,
            success: function (response) {
                if (response.status === true) {
                    window.location.href = "/offers";
                }
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });
    });
});


