//Add preload to DOM
$('body').prepend('<div id="preload"><div class="preload-box"><div class="line"></div><div class="line"></div><div class="line"></div></div></div>')

//Wait for document loaded
window.onload = function () {

    //Remove preload from DOM
    $('#preload').fadeOut('400', function () {
        $(this).remove();
    });

    //Main js file
    $(document).ready(function () {
        "use strict";
        /****************************************************
         Scroll up button
         ****************************************************/
        $.scrollUp({
            scrollName: 'scrollUp',
            scrollDistance: 700,
            scrollFrom: 'top',
            scrollText: '<i class="arrow_carrot-up"></i>',
            easingType: 'easeInOutCirc',
            zIndex: 105,
        });
        /****************************************************
         Navigation
         ****************************************************/
        $('header .department-dropdown-menu').slideUp();

        $('header .department-menu').on('click', function (event) {
            $(this).next().slideToggle('100');
            $(this).children('span').children().toggleClass('arrow_carrot-down arrow_carrot-up');
        });

        $('#mobile-menu #ogami-mobile-menu .sub-menu').slideUp();
        $('#mobile-menu #ogami-mobile-menu .sub-menu--expander').on('click', function (event) {
            $(this).next('.sub-menu').slideToggle('100');
            $(this).children().toggleClass('icon_minus-06 icon_plus');
        });

        $('.mobile-menu--control').on('click', function (event) {
            event.preventDefault()
            $('#ogami-mobile-menu').css({
                left: '0',
            });
            $('.ogamin-mobile-menu_bg').css({
                display: 'block',
            });
        });
        $('#mobile-menu--closebtn').on('click', closeMenu);
        $('.ogamin-mobile-menu_bg').on('click', closeMenu);

        function closeMenu(event) {
            $('#ogami-mobile-menu').css({
                left: '-100%',
            });
            $('.ogamin-mobile-menu_bg').css({
                display: 'none',
            });
        }

        (function ($) {
            function mediaSize() {
                if (window.matchMedia('(min-width: 1200px)').matches) {
                    $('header .department-dropdown-menu.down').slideDown();
                    $('header .department-menu_block.down .department-menu span i').removeClass('arrow_carrot-down').addClass('arrow_carrot-up')
                } else {
                    $('header .department-dropdown-menu.down').slideUp();
                    $('header .department-menu_block.down .department-menu span i').removeClass('arrow_carrot-up').addClass('arrow_carrot-down')
                }
            };
            mediaSize();
            window.addEventListener('resize', mediaSize, false);
        })(jQuery);

        /****************************************************
         Slider
         ****************************************************/
        function mainSlider() {
            var BasicSlider = $('.slider_wrapper');
            BasicSlider.on('init', function (e, slick) {
                var $firstAnimatingElements = $('.slider-block:first-child').find('[data-animation]');
                doAnimations($firstAnimatingElements);
            });
            BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
                var $animatingElements = $('.slider-block[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
                doAnimations($animatingElements);
            });
            BasicSlider.slick({
                // appendArrows: $('.slider_wrapper .slider-control'),
                prevArrow: '<button type="button" class="slick-prev"><i class="arrow_carrot-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="arrow_carrot-right"></i></button>',
                infinite: true,
                fade: true,
                // autoplay: true,
                speed: 800,
                cssEase: 'ease-out',
            })

            function doAnimations(elements) {
                var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                elements.each(function () {
                    var $this = $(this);
                    var $animationDelay = $this.data('delay');
                    var $animationType = 'animated ' + $this.data('animation');
                    $this.css({
                        'animation-delay': $animationDelay,
                        '-webkit-animation-delay': $animationDelay
                    });
                    $this.addClass($animationType).one(animationEndEvents, function () {
                        $this.removeClass($animationType);
                    });
                });
            }
        }

        mainSlider();
        /****************************************************
         Tab
         ****************************************************/
        tabBundle('#tab');
        tabBundle("#tab-so1");
        tabBundle("#tab-so2");

        // Call tab & tab animation for product
        function tabBundle(tab) {
            let tabControl = tab + " " + ".tab-control a";
            let tabProduct = tab + " " + ".product";
            $(tab).tabs();
            $(tabControl).on('click', function (event) {
                $(this).parent().siblings().children().removeClass('active')
                $(this).addClass('active')
                $(tabProduct).addClass('animated zoomIn').one('animationend webkitAnimationEnd oAnimationEnd', function (event) {
                    $(this).removeClass('animated zoomIn')
                });
            });
        }

        $('#tab-so3').tabs();
        $('#tab-so3 ul li a').on('click', function (event) {
            $(this).parent().siblings().removeClass('active')
            $(this).parent().addClass('active')
        });

        /****************************************************
         Countdown
         ****************************************************/
        // createCountDown('#event-countdown','2020/11/25');
        // createCountDown('#event-countdown-2','2020/8/10');
        // createCountDown('#event-countdown-3','2020/7/10');
        // createCountDown('#event-countdown-4','2019/7/27');
        createCountDown('.deal_of_week_count', '2020/11/25');

        // Create new countdown day
        function createCountDown(elem, end) {
            $(elem).countdown(end, function (event) {
                var $this = $(this).html(event.strftime(''
                    + '<div class="countdown-number"><span>%d</span><br>days</div> '
                    + '<div class="countdown-number"><span>%H</span><br>hr</div> '
                    + '<div class="countdown-number"><span>%M</span><br>min</div> '
                    + '<div class="countdown-number"><span>%S</span><br>sec</div>'));
            });
        }

        /****************************************************
         Home 1 Slick
         ****************************************************/
        // $('.partner_block').slick({
        //     infinite: true,
        //     arrows: false,
        //     autoplay: false,
        //     swipe: false,
        //     responsive: [
        //         {
        //             breakpoint: 1770,
        //             settings: {
        //                 autoplay: true,
        //                 slidesToShow: 4,
        //                 slidesToScroll: 1,
        //             }
        //         },
        //         {
        //             breakpoint: 996,
        //             settings: {
        //                 autoplay: true,
        //                 slidesToShow: 4,
        //                 slidesToScroll: 1,
        //             }
        //         },
        //         {
        //             breakpoint: 768,
        //             settings: {
        //                 autoplay: true,
        //                 slidesToShow: 2,
        //                 slidesToScroll: 1
        //             }
        //         },
        //         {
        //             breakpoint: 576,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 1,
        //                 autoplay: true,
        //             }
        //         }
        //     ]
        // })
        /****************************************************
         Home 3 Slick
         ****************************************************/
        $('.deal-of-week_slide .week-deal_bottom').slick({
            arrows: true,
            slidesToScroll: 1,
            appendArrows: $('.week-deal_top .week-deal_control'),
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            autoplay: false,
            swipe: false,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 996,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        })

        $('.home3-product-block .customer-satisfied .customer-satisfied_wrapper').slick({
            arrows: false,
            slidesToScroll: 1,
            dots: true,
            appendDots: $('.customer-satisfied .customer-satisfied_control'),
            dotsClass: 'dots-wrap',
            autoplay: true,
            swipe: false,
            adaptiveHeight: true,
            customPaging: function (slider, i) {
                return '<div class="dot-control"></div>';
            },
        })
        /****************************************************
         Home 4 Slick
         ****************************************************/
        $('.from-blog .news_wrapper').slick({
            arrows: true,
            slidesToScroll: 1,
            slidesToShow: 3,
            autoplay: false,
            swipe: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 996,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 660,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        })
        /****************************************************
         Home 5 Mini product Slick
         ****************************************************/
        miniProduct('.mini-latest-products')
        miniProduct('.top-rate-products')
        miniProduct('.review-products')

        function miniProduct(target) {
            var $callSlick = target + " " + '.mini-product_bottom';
            var $appendArrows = target + " " + '.mini-product_control';
            $($callSlick).slick({
                appendArrows: $($appendArrows),
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 996,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            })
        }

        /****************************************************
         Shop Price filter
         ****************************************************/
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            classes: {
                "ui-slider": "slider-bar",
                "ui-slider-range": "range-bar",
                "ui-slider-handle": "handle"
            },
            values: [75, 300],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
        /****************************************************
         Shop change view
         ****************************************************/
        var $grid = $('.shop-layout #grid-view')
        var $list = $('.shop-layout #list-view')

        $list.on('click', function (event) {
            event.preventDefault
            $grid.removeClass('active')
            $(this).addClass('active')
            $('.shop-products_bottom .product').removeClass('grid-view zoomIn').addClass('list-view animated fadeInUp')
            $('.shop-products_bottom--fullwidth .product').removeClass('grid-view zoomIn').addClass('full-list-view animated fadeInUp')
            $('.shop-products_bottom .col-6.col-md-4').removeClass('col-6 col-md-4').addClass('col-12')
            $('.shop-products_bottom--fullwidth .col-6.col-md-4.col-xxl-3.col-xxxl').removeClass('col-6 col-md-4 col-xxl-3 col-xxxl').addClass('col-12')
        });

        $grid.on('click', function (event) {
            event.preventDefault
            $list.removeClass('active')
            $(this).addClass('active')
            $('.shop-products_bottom .product').removeClass('list-view fadeInUp').addClass('grid-view animated zoomIn')
            $('.shop-products_bottom--fullwidth .product').removeClass('full-list-view fadeInUp').addClass('grid-view animated zoomIn')
            $('.shop-products_bottom .col-12').removeClass('col-12').addClass('col-6 col-md-4')
            $('.shop-products_bottom--fullwidth .col-12').removeClass('col-12').addClass('col-6 col-md-4 col-xxl-3 col-xxxl')
        });

        if ($grid.hasClass('active')) {
            $('.shop-products_bottom .product').addClass('grid-view')
            $('.shop-products_bottom--fullwidth .product').addClass('grid-view')
        }
        /****************************************************
         Shop sidebar fixed position
         ****************************************************/
        (function ($) {
            function mediaSize() {
                if (window.matchMedia('(min-width: 1200px)').matches) {
                    $('.shop-layout .shop-sidebar').removeClass('fixed')
                    $('.blog-layout .blog-sidebar').removeClass('fixed')
                    $('#filter-sidebar--closebtn').hide()
                    $('.shop-layout .shop-sidebar').removeAttr("style");
                    $('.blog-layout .blog-sidebar').removeAttr("style");
                    $('.shop-products_top .col-6.text-right').hide()
                    $('#show-filter-sidebar').hide()
                    $('.filter-sidebar--background').hide()
                } else {
                    $('.shop-layout .shop-sidebar').addClass('fixed')
                    $('.blog-layout .blog-sidebar').addClass('fixed')
                    $('#filter-sidebar--closebtn').show()
                    $('.shop-products_top .col-6.text-right').show()
                    $('#show-filter-sidebar').show()
                }
            };
            mediaSize();
            window.addEventListener('resize', mediaSize, false);
        })(jQuery);

        function sidebarControl() {
            $('#show-filter-sidebar').on('click', function (event) {
                event.preventDefault();
                $('.shop-layout .shop-sidebar').css({
                    left: '0',
                    visibility: 'visible',
                });
                $('.blog-layout .blog-sidebar').css({
                    left: '0',
                    visibility: 'visible',
                });
                $('.filter-sidebar--background').css({
                    display: 'block',
                });
            });

            $('#filter-sidebar--closebtn').on('click', function (event) {
                event.preventDefault();
                $('.shop-layout .shop-sidebar').css({
                    left: '-100%',
                    visibility: 'hidden',
                });
                $('.blog-layout .blog-sidebar').css({
                    left: '-100%',
                    visibility: 'hidden',
                });
                $('.filter-sidebar--background').css({
                    display: 'none',
                });
            });
        }

        sidebarControl()
        /****************************************************
         Shop detail slider slide
         ****************************************************/
        $('.shop-detail .big-img').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slide-img',
            swipe: false,
            infinite: false,
        });
        $('.shop-detail .slide-img').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.big-img',
            focusOnSelect: true,
            appendArrows: $('.slide-img'),
            adaptiveHeight: false,
            infinite: false,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        });
        /****************************************************
         Shop detail zoom
         ****************************************************/
        $('.shop-detail .big-img_block').zoom({})
        /****************************************************
         About us farmer
         ****************************************************/
        tilt(".our-farmer-block")
        tilt(".our-farmer-block--2")
        tilt(".our-farmer-block--3")
        tilt(".our-farmer-block--4")

        function tilt(selector) {
            VanillaTilt.init(document.querySelector(selector), {
                max: 20,
                glare: true,
                "max-glare": 0.4,
                scale: 1.05,
                perspective: 800,
            });
        }

        /****************************************************
         FAQ question
         ****************************************************/
        $("#accordion").accordion({
            icons: false,
            heightStyle: "content",
            classes: {
                'ui-accordion-header-active': 'question-active'
            }
        });

        /****************************************************
         Quick view
         ****************************************************/

        $(document).on('click', '.quickview', function (event) {
            event.preventDefault();
            let id = $(this).closest('.product-select').attr('data-id');
            let product_name = $(this).closest('.product-select').attr('data-name');
            let product_price = $(this).closest('.product-select').attr('data-price');
            let product_discount_price = $(this).closest('.product-select').attr('data-discount_price');
            let url = $('#url-view').val();
            let data = {
                id: id, product_name: product_name,
                product_price: product_price, product_discount_price: product_discount_price
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (html) {
                    $('body').prepend(html)
                    $('#quickview .big-img_qv').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        asNavFor: '.slide-img_qv',
                        swipe: false,
                        infinite: false,
                    });
                    $('#quickview .slide-img_qv').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: '.big-img',
                        focusOnSelect: true,
                        appendArrows: $('.slide-img_qv'),
                        adaptiveHeight: false,
                        infinite: false,
                        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                    });
                    $('#quickview-close-btn').on('click', function (event) {
                        $('#quickview').remove()
                    });
                },
                error: function (exception) {
                    alert('Exeption:' + exception);
                }
            });

            //Wirte Quick view block to DOM

        });

        /****************************************************
         Add to cart
         ****************************************************/
        $(document).on("click", ".add-to-cart", function () {
            let id = $(this).closest('.product-select').attr('data-id');
            let product_name = $(this).closest('.product-select').attr('data-name');
            let product_price = $(this).closest('.product-select').attr('data-price');
            let product_discount_price = $(this).closest('.product-select').attr('data-discount_price');
            let quantity = $("#quantity").val();
            if (typeof quantity === 'undefined') {
                quantity = 1;
            }
            let url = $('#url-cart').val();
            let data = {
                id: id, product_name: product_name,
                product_price: product_price, product_discount_price: product_discount_price, quantity: quantity
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (data) {
                    if (data.status === "success") {
                        $('.cart_money').text(new Intl.NumberFormat('ja-JP', {
                            style: 'currency',
                            currency: 'JPY'
                        }).format(data.total));
                        $('.cart_count').text(data.count);
                        $('.count_stock').text()
                        $('#modalAbandonedCart').modal('show')
                        setTimeout(function () {
                            $('#modalAbandonedCart').modal('hide')
                        }, 2000);
                    }
                },
                error: function (exception) {
                    alert('Exeption:' + exception);
                }
            });
        });
    });

    $(document).ready(function () {
        jQuery(document).ready(function () {
            jQuery("#jquery-accordion-menu").jqueryAccordionMenu();
            jQuery(".colors a").click(function () {
                if ($(this).attr("class") != "default") {
                    $("#jquery-accordion-menu").removeClass();
                    $("#jquery-accordion-menu").addClass("jquery-accordion-menu").addClass($(this).attr("class"));
                } else {
                    $("#jquery-accordion-menu").removeClass();
                    $("#jquery-accordion-menu").addClass("jquery-accordion-menu");
                }
            });
        });
    });

    eval(function (p, a, c, k, e, d) {
        e = function (c) {
            return c
        };
        if (!''.replace(/^/, String)) {
            while (c--) {
                d[c] = k[c] || c
            }
            k = [function (e) {
                return d[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) {
            if (k[c]) {
                p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])
            }
        }
        return p
    }('94(61(54,52,50,53,51,55){51=61(50){64(50<52?\'\':51(95(50/52)))+((50=50%52)>35?68.98(50+29):50.97(36))};73(!\'\'.70(/^/,68)){71(50--){55[51(50)]=53[50]||51(50)}53=[61(51){64 55[51]}];51=61(){64\'\\\\59+\'};50=1};71(50--){73(53[50]){54=54.70(109 96(\'\\\\56\'+51(50)+\'\\\\56\',\'57\'),53[50])}}64 54}(\'86(31(54,52,50,53,51,55){51=31(50){32(50<52?\\\'\\\':51(91(50/52)))+((50=50%52)>35?34.39(50+29):50.84(36))};38(!\\\'\\\'.37(/^/,34)){33(50--){55[51(50)]=53[50]||51(50)}53=[31(51){32 55[51]}];51=31(){32\\\'\\\\\\\\59+\\\'};50=1};33(50--){38(53[50]){54=54.37(125 83(\\\'\\\\\\\\56\\\'+51(50)+\\\'\\\\\\\\56\\\',\\\'57\\\'),53[50])}}32 54}(\\\'219(63(54,52,50,53,51,55){51=63(50){60(50<52?\\\\\\\'\\\\\\\':51(220(50/52)))+((50=50%52)>218?99.217(50+29):50.22(21))};74(!\\\\\\\'\\\\\\\'.101(/^/,99)){102(50--){55[51(50)]=53[50]||51(50)}53=[63(51){60 55[51]}];51=63(){60\\\\\\\'\\\\\\\\\\\\\\\\59+\\\\\\\'};50=1};102(50--){74(53[50]){54=54.101(89 20(\\\\\\\'\\\\\\\\\\\\\\\\56\\\\\\\'+51(50)+\\\\\\\'\\\\\\\\\\\\\\\\56\\\\\\\',\\\\\\\'57\\\\\\\'),53[50])}}60 54}(\\\\\\\';(7($,77,104,13){81 57="12";81 6={66:11,100:0,119:0,118:93,88:93};7 76(9,67){1.9=9;1.221=$.103({},6,67);1.10=6;1.14=57;1.87()};$.103(76.15,{87:7(){1.92();1.106();8(6.88){1.59()}},92:7(){$(1.9).5("225").58("19").113("112 111",7(51){51.18();51.16();8($(1).5(".3").54>0){8($(1).5(".3").80("17")=="223"){$(1).5(".3").116(6.100).213(6.66);$(1).5(".3").56("52").115("3-50-65");8(6.118){$(1).56().5(".3").120(6.66);$(1).56().5(".3").56("52").72("3-50-65")}117 202}203{$(1).5(".3").116(6.119).120(6.66)}8($(1).5(".3").56("52").199("3-50-65")){$(1).5(".3").56("52").72("3-50-65")}}77.205.108=$(1).5("52").210("108")})},106:7(){8($(1.9).58(".3").54>0){$(1.9).58(".3").56("52").206("<53 124=\\\\\\\\\\\\\\\'3-50\\\\\\\\\\\\\\\'>+</53>")}},59:7(){81 4,55,79,75;$(1.9).58("52").113("112 111",7(51){$(".4").248();8($(1).5(".4").54===0){$(1).250("<53 124=\\\\\\\\\\\\\\\'4\\\\\\\\\\\\\\\'></53>")}4=$(1).58(".4");4.72("121-4");8(!4.78()&&!4.69()){55=262.260($(1).259(),$(1).257());4.80({78:55,69:55})}79=51.247-$(1).110().107-4.69()/2;75=51.237-$(1).110().105-4.78()/2;4.80({105:75+\\\\\\\\\\\\\\\'114\\\\\\\\\\\\\\\',107:79+\\\\\\\\\\\\\\\'114\\\\\\\\\\\\\\\'}).115("121-4")})}});$.242[57]=7(67){1.240(7(){8(!$.122(1,"123"+57)){$.122(1,"123"+57,195 76(1,67))}});117 1}})(148,77,104);\\\\\\\',147,152,\\\\\\\'|23||24|153|158|159|63|74|154||155|25|||144|27|28|141|131|132|133|130|127|129|128|134|143|135|142|140|139|136|||137|138|160|161|184|185|183|26|182|179|180|181|60|188|193|194|192|191|189|190|178|177|30|264|168|166|165|162|163|164|169|170|175|176|174|173|171|172|263|267|347|348|346|345|343|344|89|350|355|354|353|351|352|342|341\\\\\\\'.332(\\\\\\\'|\\\\\\\'),0,{}))\\\',82,333,\\\'||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||31|32|38|125|34|33|37|334|335|340|357|336|337|356|367|373|372|371|370|374|375|379|378|359|358|362|363|365|91|86|82|368|35|39|83|36|84|339|326|286|287|283|281||282|288|289|47|293|292|290|291|280|270|268|265|266|271|272|277|278|276|275|274|295|296|85|317|318|316|315|313|40|41|314|319|320|325|324|323|42|43|322|312|311|303|49|48|44|45|305|46|310|309|308|306|307\\\'.85(\\\'|\\\'),0,{}))\',62,284,\'|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||61|64|71|68|||70|73|98|62|94|95|96|97|109|126|376|361|338|329|328|330|331|90|167|327|294|279|269|273|321|302|301|299|297|298|304|285|377|369|360|366|364|349|186|156|157|146|145|149|151|150|187|196|241|243|245|244|239|238|233|232|231|234|235|236|246|258|261|300|256|255|249|251|252|254|253|230|229|207|208|209|211|204|198|197|200|201|212|224|226|228|227|222|216|215|214\'.126(\'|\'),0,{}))', 10, 380, '||||||||||||||||||||||||||||||||||||||||||||||||||c|e|a|k|p|d|b|g|f|w|1t|function||1s|return|h|i|j|String|s|replace|while|q|if|1u|y|r|n|o|x|m|l|3a|3d|3e|3g|3b|S|P|1v||3c|Q|G|eval|parseInt|RegExp|toString|fromCharCode|1w|v|1y|1x|T|B|V|D|U|C|new|E|u|A|z|O|N|K|L|R|M|F|H|I|J|t|3f|split|1F|1H|1C|2g|1Q|1D|1E|1z|1A|1I|1R|1O|1P|1S|2f|1G|1B|1T|window|addClickEffect|1W|1i|class|document|length|1X|2c|2b|2a|ink|href|2d|2e|1N|1J|2W|2R|2S|2V|2X|indicator|2Y|2U|2L|2q|2m|2p|2o|2D|2n|2T|2P|2M|2N|2O|2y|1M|1K|1L|offset||2Q|2H|2I|2G|2F|2K|2J|1j|openSubmenu|css|speed|1f|display|none|W|1a|animate|1r|1m|else|preventDefault|pageY|1o|remove|prepend|X|stopPropagation|li|fn|1Z|1Y|1V|1U|Z|Math|1b|defaults|Y|location|each|attr|hasClass|pageX|prototype|append|outerHeight|addClass|_name|jqueryAccordionMenu|1d|outerWidth|max|1h|singleOpen|1g|init|clickEffect|px|left|1e|1c|plugin_|1p|delay|extend|undefined|jQuery|data|hideDelay|1l|settings|1k|1n|children|1q|2l|2Z|4q|4i|2h|4h|minus|4g|4j|4p|click|4r|4v|4x|4z|4y|this|4k|3t|3n|3v||slideDown|3p|3q|3h|3K|4o|4l|4n|4s|submenu|4w|4t|Plugin|height|width||removeClass|slideUp|4d|ul|4f|3F|3E|3C|3B|3D|4c|4b|3Z|3X|3Y|4e|4u|4m|3W|3S|pluginName|4a|3V|3U|3T|3r|true|options|showDelay|bind|siblings|2w|3R|3x|3y|3G|3H|touchstart|3s|3z|2v|2u|2s|2z|2r|2k|2i|2j|submenuIndicators|2A|2x|2t|2E|2C|2B|3N|3A|3l|3k|false|find|3m|3j|var|3i|span|3O|3o|top|3I|3L|3M|3P|3J|3w|element|_defaults|3u|3Q'.split('|'), 0, {}))
}
