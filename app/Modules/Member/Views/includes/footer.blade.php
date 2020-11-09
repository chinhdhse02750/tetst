<div class="footer__primary">
    <div class="footer-wrap">
        <div class="row">
            <div class="col-md-3">
                <div class="footer__information">
                    <a class="footer__logo" href="#">
                        <img src="/image/frontend/logo_footer.svg" alt="Oriental Club">
                    </a>
                    <p class="text--small">営業時間：11時～21時 / 休日：土日・祝祭日</p>
                    <div class="footer__information-more">
                        <div class="row">
                            <div class="col">
                                <img src="/image/frontend/qr_code.svg" alt="Oriental Club">
                            </div>
                            <div class="col">
                                <p class="text--small">携帯サイトからも</p>
                                <p class="text--small">セッティング申し込み</p>
                                <p class="text--small">が可能です。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="footer__list-blog">
                    <div class="row">
                        @if(!empty($banners))
                            @foreach($banners as $banner)
                                <div class="col-md-4">
                                    <div class="footer__item-blog">
                                        <a href="{{ $banner->redirect_url }}" class="footer_item-link" target="_blank">
                                            <img src="{{ $banner->media->media_url }}" alt="{{ $banner->redirect_url }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <p class="footer__copyright text--small">© Oriental Club</p>
            </div>
        </div>
    </div>
</div>
