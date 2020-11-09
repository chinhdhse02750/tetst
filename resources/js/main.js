if (document.getElementById('menu-mobile')) {
    document.addEventListener(
        "DOMContentLoaded", () => {
            new Mmenu( "#menu-mobile" );
        }
    );
}
$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
        // ... more custom settings?
    });
    lazyLoadInstance.update();

    var filter_collapse = $('.js-collapse');
    filter_collapse.on('show.bs.collapse', function () {
        $(this).prev().addClass('has_collapse');
    });

    filter_collapse.on('hide.bs.collapse', function () {
        $(this).prev().removeClass('has_collapse');
    });

    $('.js-top__title-filter').on('click', function () {
        $(this).next().toggleClass('active');
    });

    $('.js-show-password').on('click', function () {
        $(this).toggleClass('active');
        if ($(this).prev().attr('type') === 'password') {
            $(this).prev().attr('type', 'text');
        } else {
            $(this).prev().attr('type', 'password');
        }
    });
    $('.js-button__clear-content').on('click', function () {
        $(this).prev().removeClass('is-invalid');
        $(this).prev().attr('value', '');
        $(this).next().remove();
        $(this).remove();
    });
});
