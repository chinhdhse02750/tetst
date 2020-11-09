$(document).ready(function () {
    $('#generate-payment-link').on('click', function () {
        let id = $('#id').val();
        let public_id = $('#public_id').val();
        let data = new FormData();
        data.append( 'id', id );
        data.append( 'public_id', public_id );
        let url = $('#url-gen-payment-link').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#paypal-link-area').attr("href", data).text(data);
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });
    });

    $('#status').on('change', function() {
        $('#reject-message').prop("disabled", true);
        $('#reject-message-hidden').prop("disabled", false);
        $('#generate-payment-link').prop("disabled", false);
        if(parseInt(this.value) === 2){
            $('#reject-message').prop("disabled", false);
            $('#reject-message-hidden').prop("disabled", true);
        }
        if(parseInt(this.value) === 1){
            $('#generate-payment-link').prop("disabled", true);
        }
    });

    $('#coppy-payment-link').on('click', function(e) {
        e.preventDefault();
        let copyText = $('#paypal-link-area').attr("href");
        let textarea = document.createElement("textarea");
        textarea.textContent = copyText;
        textarea.style.position = "fixed";
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);
    });
});
