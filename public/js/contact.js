$(document).ready(function () {

    $('#content').bind('input propertychange', function () {
        if (this.value.length > 0) {
            $('#btn-send-contact').attr('disabled', false);
        } else {
            $('#btn-send-contact').attr('disabled', true);
        }
    });

    $('#btn-send-contact').on('click', function () {
        let user_id = $('#user-id').val();
        let title = $('#title').val();
        let content = $('#content').val();
        let status = $('#status').val();
        let url = $('#url-send-contact').val();
        let alert_message = $('#alert-message').val();
        let fd = createFormData(user_id, title, content, status);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: fd,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status === true) {
                    alert(stripHtml(alert_message));
                    window.location.href = "/";
                }
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });

    });


    function stripHtml(html) {
        let tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }

    function createFormData(user_id, title, content, status) {
        let fd = new FormData();
        fd.append('user_id', user_id);
        fd.append('title', title);
        fd.append('content', content);
        fd.append('status', status);

        return fd;
    }
});


