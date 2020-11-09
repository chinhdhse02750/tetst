$(document).ready(function(){
  $(".js-icon_clear").on('click', function () {
    let inputError = $(this).prev();
    let spanError = $(this).parent('.admin-input-acc').next();
    inputError.removeClass('is-invalid');
    inputError.val('');
    spanError.remove();
    $(this).remove();
  })
});
