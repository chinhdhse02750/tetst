$(document).ready(function() {
  $("#detailSlide").lightSlider({
    gallery: true,
    item: 1,
    loop: true,
    slideMargin: 0,
    thumbItem: 6,
    galleryMargin: 0,
    thumbMargin: 3,
    minPgr: 1,
  });

  $("#galleryVideo").lightSlider({
    gallery: false,
    item: 3,
    loop: true,
    slideMargin: 22,
  });

  $("#galleryImage").lightSlider({
    gallery: false,
    item: 6,
    loop: true,
    slideMargin: 3,
  });

  $("#detailSlide, #galleryImage, #galleryVideo").lightGallery({
    mode: 'lg-fade',
    addClass: 'fixed-size',
    thumbnail: false,
    download: false,
    startClass: '',
    counter: false,
    speed: 500
  });

  $('.js-modal').on('click', function () {
    let target = $(this).attr('data-target-modal');
    $('.' + target + ' .modal-custom').toggleClass('active');
  });

  $('.modal-custom__overlay').on('click', function () {
    $('.detail__modal .modal-custom').removeClass('active');
  });
  calculatorImg('.item__image-public');
  calculatorImg('.gallery-image__item');
  calculatorImg('.item__image-private');
  calculatorImg('.container-detail__slide .lSPager li, .item__image-private');
  $(window).resize(function () {
    setTimeout(function(){
      calculatorImg('.item__image-public', '#detailSlide');
      calculatorImg('.gallery-image__item', '#galleryVideo');
      calculatorImg('.item__image-private', '#galleryImage');
      calculatorImg('.container-detail__slide .lSPager li, .item__image-private');
    }, 210);
  });
});

function calculatorImg(element, parent = '') {
  let elementWidth = $(element).width();
  let calHeight = elementWidth * 0.75;
  if (parent !== '') {
    $(parent).height(calHeight);
  }

  $(element).height(calHeight);
}
