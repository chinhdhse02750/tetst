navDropdown('#btn-language', "#dropdown-language");
navDropdown('#btn-account', "#dropdown-account");

function navDropdown(button, dropdownItem) {
  $(button).on('click', function () {
    $(dropdownItem).toggleClass('show');
    $(button).toggleClass('active');
  })

  $( "body" ).click(function( event ) {
    let eventTargetData = event.target.getAttribute('data-btn');
    if('#'+eventTargetData !== button){
      $(dropdownItem).removeClass('show');
      $(button).removeClass('active');
    }
  });
}
