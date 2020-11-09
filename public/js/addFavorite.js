$(document).on('click', '.favorite-btn', function() {
    let __self = $(this);
    __self.removeClass('favorite-btn');
    let data = {favorite_id: $(this).data('favorite-id')},
        userId = $(this).data('user-id'),
        url = "api/v1/users/" + userId + "/favorite";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        type: 'POST',
        data: data ,
        success: function (response) {
            console.log(__self);
            if(response.status){
                __self.toggleClass('active');
                if(window.location.pathname === '/favorites'){
                    location.reload();
                }
            }

            __self.addClass('favorite-btn');
        }
    });
});
