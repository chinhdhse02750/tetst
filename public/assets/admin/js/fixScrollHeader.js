let delay = 0;
let offset = 150;
document.addEventListener('invalid', function(e){
    $(e.target).addClass("invalid");
    $('html, body').animate({scrollTop: $($(".invalid")[0]).offset().top - offset }, delay);
}, true);
document.addEventListener('change', function(e){
    $(e.target).removeClass("invalid")
}, true);
