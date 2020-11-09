$(document).ready(function () {
    $('.button-active-user').on('change', function (e) {
        const active = 1;
        const inActive = 0;
        let url = $('#edit-status-url').val();
        let status = inActive;
        if ($('input[name="active_user"]').prop('checked') === true) {
            status = active;
        }
        let data = {active: status};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'PUT',
            data: data,
            success: function (response) {
                if (response.status === true) {
                    $('#message-update-status').html(`<div class="alert alert-success message-update-status">
                             <button class="close" data-dismiss="alert">x</button>
                             <p class="alert-status">${response.error.message}</p></div>`);
                }
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });
    });
});
