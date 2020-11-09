$(document).ready(function () {

    $(':input[type="submit"]').prop('disabled', false);

    $("#setting-offer").submit(function (e) {
        $(':input[type="submit"]').prop('disabled', true);
    });

    $('.image-setting-list').css("background", "#272727");

    $("#priority").sortable({
        update: function() {
            let $lis = $(this).children('.ui-sortable-handle');
            $lis.each(function() {
                let newVal = $(this).index() + 1;
                $(this).children('.pri_handler').children('.sort-change').html(newVal);
            });
        }
    });

    $('.ulink').on('click', function () {
        let url =  $(this).data("url");
        let removeId = $(this).data("id");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: url,
            processData: true,
            contentType: true,
            success: function (response) {
                // window.open('/offers', '_blank');
                console.log(response.data.length);
                if (response.data.length > 0) {
                    $('#' + removeId).parent().remove();
                } else {
                    window.location.href = "/";
                }
            },
            error: function (exception) {
                alert('Exeption:' + exception);
            }
        });
    });


});


