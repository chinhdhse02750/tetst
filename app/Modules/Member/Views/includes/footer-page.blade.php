<footer>

    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row ">
                <div class="col-md-4 col-lg-4 footer-about row-mobile m-b-15"
                     style="visibility: visible; animation-name: fadeInUp;">
                    <h3 class="text-section-footer">Giới thiệu</h3>
                    <div class="d-flex justify-content-center">
                        <img class="logo-footer" src="{{ asset('images/logo_hn_taphoa.png') }}" alt="logo-footer"
                             data-at2x="assets/img/logo.png">
                    </div>
                    <p class="footer-text-describe">
                        Đưa ẩm thực Việt tới Nhật Bản. Sản phẩm gồm thực phẩm, gia vị, đặc sản, các nguyên liệu chế
                        biến món ăn Việt Nam.
                    </p>
                </div>

                <div class="col-md-4 col-lg-4 footer-contact row-mobile m-b-15"
                     style="visibility: visible; animation-name: fadeInDown;">
                    <h3 class="text-section-footer">Liên hệ</h3>
                    <p class="font-weight-bold"><i class="fas fa-map-marker-alt"></i> Chi nhánh Kobe 〒652-0035</p>
                    <p class="fs-14px">神戸市兵庫区西多聞通1丁目3番28号フラワーマンション1</p>
                    <p class="font-weight-bold"><i class="fas fa-map-marker-alt"></i> Chi nhánh Hyogo 〒652-0803</p>
                    <p class="fs-14px">神戸市兵庫区大開通8丁目1-16-1F</p>
                    <p><i class="fas fa-phone"></i> <span class="font-weight-bold">Phone:</span> 080-5316-7125</p>
                    <p><i class="fas fa-envelope"></i> <span class="font-weight-bold">Email:</span> <a
                                href="mailto:hanoitaphoa.jp@gmail.com">hanoitaphoa.jp@gmail.com</a>
                    </p>
                    <p><i class="fab fa-skype"></i> <span class="font-weight-bold">Skype:</span> you_online</p>
                </div>

                <div class="col-md-4 col-lg-4 footer-social row-mobile m-b-15"
                     style="visibility: visible; animation-name: fadeInUp;">
                    <h3 class="text-section-footer">Về Hà Nội Shop</h3>
                    <div class="fb-page"
                         data-href="https://www.facebook.com/H&#xe0;-N&#x1ed9;i-T&#x1ea1;p-Ho&#xe1;-110692747177363/"
                         data-tabs="" data-width="" data-height="" data-small-header="false"
                         data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote
                                cite="https://www.facebook.com/H&#xe0;-N&#x1ed9;i-T&#x1ea1;p-Ho&#xe1;-110692747177363/"
                                class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/H&#xe0;-N&#x1ed9;i-T&#x1ea1;p-Ho&#xe1;-110692747177363/">Hà
                                Nội Tạp Hoá</a></blockquote>
                    </div>
                    {{--<div class="footer-social" style="margin-top: 20px">--}}
                    {{--<a class="round-icon-btn bg-fb" href="">--}}
                    {{--<i class="fab fa-facebook-f"> </i>--}}
                    {{--</a>--}}
                    {{--<a class="round-icon-btn bg-tw" href="">--}}
                    {{--<i class="fab fa-twitter"></i>--}}
                    {{--</a>--}}
                    {{--<a class="round-icon-btn bg-in" href="">--}}
                    {{--<i class="fab fa-invision"> </i>--}}
                    {{--</a>--}}
                    {{--<a class="round-icon-btn bg-prin" href="">--}}
                    {{--<i class="fab fa-pinterest-p"></i>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    {{--<div class="newletter">--}}
    {{--<div class="container">--}}
    {{--<div class="row justify-content-between align-items-center">--}}
    {{--<div class="col-12 col-md-7">--}}
    {{--<div class="newletter_text text-center text-md-left">--}}
    {{--<h5>Join Our Newsletter Now</h5>--}}
    {{--<p>Get E-mail updates about our latest shop and special offers.</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-12 col-md-5">--}}
    {{--<div class="newletter_input">--}}
    {{--<input class="round-input" type="text" placeholder="Enter your email">--}}
    {{--<button>Subcribe</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="footer-credit">--}}
    {{--<div class="container">--}}
    {{--<div class="footer-creadit_block d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-baseline align-items-md-center">--}}
    {{--<p class="author">Copyright © 2019 Ogami - All Rights Reserved.</p><img class="payment-method"--}}
    {{--src="/images/payment.png"--}}
    {{--alt="">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
</footer>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0"
        nonce="7O58XwtG">
</script>
<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "110692747177363");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v11.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
