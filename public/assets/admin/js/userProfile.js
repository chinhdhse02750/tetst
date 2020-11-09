$('input[name=label_type]').on('click', function () {
    if($(this).attr('id') === 'other'){
        $('.custom-label').removeClass('d-none');
    } else {
        $('.custom-label').addClass('d-none');
    }
});

$('input[name=receipt_type]').on('click', function () {
    console.log('aa');
    if($(this).attr('id') !== 'no_receipt'){
        $('.receipt_description').removeClass('d-none');
    } else {
        $('.receipt_description').addClass('d-none');
    }
});

$("#favorite_dating_type_0").click(function () {
    if($(this).is(':checked')){
        $("input[type=checkbox][name='favorite_dating_type[]']").not(this).prop('checked', false);
    }
});

$("input[type=checkbox][name='favorite_dating_type[]']").not('#favorite_dating_type_0').click(function () {
    if($(this).is(':checked')){
        $("#favorite_dating_type_0").prop('checked', false);
    }
});
