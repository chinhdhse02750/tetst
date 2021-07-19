
<div class="shop-sidebar">
    <div class="shop-sidebar_department">
        <input type="hidden" value="{{ url('api/v1/product/cart') }} " id="url-cart">
        <input type="hidden" value="{{ url('api/v1/product/comment') }} " id="url-comment">
        <div class="department_top mini-tab-title underline">
            <h2 class="title">Tài khoản</h2>
        </div>
        <div class="department_bottom">
            <ul class="ul-parent">
                <li class="{{ active_class(Route::is('profile.password')) }} menu-toggle menu-parent">
                    <a href="{{ route('profile.password') }}"
                       class="department-link link-parent">Đơn hàng</a>
                </li>

                <li class="{{ active_class(Route::is('profile.index')) }} menu-toggle menu-parent">
                    <a href="{{ route('profile.index') }}"
                       class="department-link link-parent">Thông tin đăng ký</a>
                </li>
                <li class="{{ active_class(Route::is('profile.password')) }} menu-toggle menu-parent">
                    <a href="{{ route('profile.password') }}"
                       class="department-link link-parent">Thay đổi mật khẩu</a>
                </li>

            </ul>
        </div>
    </div>
</div>

