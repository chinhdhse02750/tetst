<div id="quickview">
    <div class="quickview-box">
        <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times">
            </i></button>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="shop-detail_img">
                    <button class="round-icon-btn" id="zoom-btn">
                        <i class="icon_zoom-in_alt"></i>
                    </button>
                    <div class="big-img big-img_qv">
                        @foreach($images as $key => $value)
                            <div class="big-img_block">
                                <img src="{{ url('storage/tmp/'.$value) }}"  alt="{{ $value }}">
                            </div>
                        @endforeach

                    </div>
                    <div class="slide-img slide-img_qv">
                        @foreach($images as $key => $value)
                            <div class="slide-img_block">
                                <img src="{{ url('storage/tmp/thumbnail_'.$value) }}" alt="{{ $value }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6"> <span class="shop-detail_info">
                <a class="product-name" href="shop_detail.html">{{ $products->name }}</a>
                <div class="price-rate"> <h3 class="product-price"> <del>¥{{ $products->price }}</del>¥{{ $products->discount_price }}</h3> </div>
                <p class="product-describe">{{ $products->description }}</p>
                <div class="quantity-select"> <label for="quantity">Số lượng:</label>
                    <input class="no-round-input" id="quantity" type="number" min="0" value="1">
                    <label class="total_product_view"><span class="count_stock">{{ $products->stock }}</span> @lang('product.label.in_stock')</label>
                </div>
                <div
                     class="product-select" data-id="{{ $products->id }}"
                     data-name="{{ $products->name }}" data-price="{{ $products->price }}"
                     data-discount_price="{{ $products->discount_price }}">
                    <button class="add-to-cart normal-btn outline">@lang('product.label.add_to_cart')</button>
{{--                    <button class="add-to-compare normal-btn outline">+ Add to Compare</button>--}}
                </div>
{{--                <div class="product-share"> <h5>Share link:</h5>--}}
{{--                    <a href=""><i class="fab fa-facebook-f"> </i></a>--}}
{{--                    <a href=""><i class="fab fa-twitter"></i></a>--}}
{{--                    <a href=""><i class="fab fa-invision"> </i></a>--}}
{{--                    <a href=""><i class="fab fa-pinterest-p"></i></a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
