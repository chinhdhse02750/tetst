$(document).ready(function () {
  $('#search-offer').on('click', function () {
    let url = $('#url-search-offer').val();
    let request = $('#search-offer-form').serialize();
    if ($("#search-offer-form")[0].checkValidity()) {
      $.ajax({
        type: 'GET',
        url: url,
        data: request,
        processData: true,
        contentType: true,
        success: function (data) {
          $('#search-offer-append').html(data);
          $('#search-offer').prop("disabled", false);
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
    let request = $('#search-offer-form').serialize();
    let url = $('#url-search-offer').val();
    $.ajax({
      type: 'GET',
      url: url,
      data: request + '&page=' + page,
      processData: true,
      contentType: true,
      success: function (data) {
        $('#search-offer-append').html(data);
        $('#search-offer').prop("disabled", false);
      },
      error: function (exception) {
        alert('Exeption:' + exception);
      }
    });
  });
});
