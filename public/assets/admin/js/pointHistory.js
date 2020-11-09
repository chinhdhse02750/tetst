$(document).ready(function () {
    $('#search-point-history').on('click', function () {
        let url = $('#url-search-point').val();
        let request = $('#search-point-form').serialize();
        if ($("#search-point-form")[0].checkValidity()) {
            $.ajax({
                type: 'GET',
                url: url,
                data: request,
                processData: true,
                contentType: true,
                success: function (data) {
                    $('#search-point-append').html(data);
                    $('#search-point-history').prop("disabled", false);
                },
                error: function (exception) {
                    alert('Exeption:' + exception);
                }
            });
        }
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let request = $('#search-point-form').serialize();
        let url = $('#url-search-point').val();
        $.ajax({
            type: 'GET',
            url: url,
            data: request + '&page=' + page,
            processData: true,
            contentType: true,
            success: function (data) {
                $('#search-point-append').html(data);
                $('#search-point-history').prop("disabled", false);
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });
    });
});
