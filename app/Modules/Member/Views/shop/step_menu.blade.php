<div class="row">
    <div class="col-12">
        <div class="order-step_block">
            <div class="row no-gutters">
                <div class="col-12 col-md-4">
                    <a href="{{ route('cart.index') }}">
                        <div class="step-block {{ (request()->is('cart')) ? 'active' : '' }}">
                            <div class="step">
                                <h2>Giỏ hàng</h2><span>01</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4">
                    <a href="{{ route('cart.checkout') }}">
                        <div class="step-block {{ (request()->is('cart-checkout')) ? 'active' : '' }}">
                            <div class="step">
                                <h2>Thông tin thanh toán</h2><span>02</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4">
                    <div class="step-block  {{ (request()->is('order-complete')) ? 'active' : '' }}">
                        <div class="step">
                            <h2>Hoàn tất đặt hàng</h2><span>03</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>