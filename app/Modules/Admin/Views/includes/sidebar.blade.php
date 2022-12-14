<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('labels.general.menu')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin.dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon cil-clipboard"></i>
                    @lang('labels.menu.dashboard')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/order*')) }}"
                   href="{{ route('order.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.order_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/category*')) }}"
                   href="{{ route('products.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.product_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/category*')) }}"
                   href="{{ route('categories.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.category_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/units*')) }}"
                   href="{{ route('units.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.units_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/tag*')) }}"
                   href="{{ route('tags.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.tag_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/comment*')) }}"
                   href="{{ route('comments.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.comment_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(\Request::is('admin/shipping*')) }}"
                   href="{{ route('shipping.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.shipping_management')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link{{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('banners.index') }}">
                    <i class="nav-icon cil-inbox"></i>
                    @lang('labels.menu.banner')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link{{
                                active_class(Route::is('admin/auth*'))
                            }}" href="{{ route('news.index') }}">
                    <i class="nav-icon cil-bell"></i>
                    @lang('labels.menu.notification_management')
                </a>
            </li>

            {{--<li class="nav-item nav-dropdown {{--}}
                    {{--active_class(Route::is('admin/auth*'), 'open')--}}
                {{--}}">--}}
                {{--<a class="nav-link nav-dropdown-toggle {{--}}
                        {{--active_class(Route::is('admin/auth*'))--}}
                    {{--}}" href="#">--}}
                    {{--<i class="nav-icon far fa-user"></i>--}}
                    {{--@lang('labels.menu.member_management')--}}
                {{--</a>--}}

                {{--<ul class="nav-dropdown-items">--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link nav-child {{--}}
                    {{--active_class(\Request::is('admin/member*'))--}}
                {{--}}" href="{{ route('member.index', 'female') }}">--}}
                            {{--<i class="nav-icon cil-wc"></i>--}}
                            {{--@lang('labels.menu.user_management')--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--@can('balances_management')--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link nav-child {{--}}
                    {{--active_class(Route::is('admin/balances'))--}}
                {{--}}" href="{{ route('member.balances') }}">--}}
                                {{--<i class="nav-icon cib-auth0"></i>--}}
                                {{--@lang('labels.menu.balances')--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endcan--}}

                    {{--@can('offer_management')--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link nav-child {{--}}
                                {{--active_class(Route::is('admin/auth/user*'))--}}
                            {{--}}" href="{{ route('offers.index') }}">--}}
                                {{--<i class="nav-icon cib-todoist"></i>--}}
                                {{--@lang('labels.menu.offer')--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endcan--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="divider"></li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link {{--}}
                    {{--active_class(\Request::is('admin/contact*'))--}}
                {{--}}" href="{{ route('contact.index') }}">--}}
                    {{--<i class="nav-icon cil-envelope-closed"></i>--}}
                    {{--@lang('labels.menu.contact')--}}
                {{--</a>--}}
            {{--</li>--}}


            <li class="nav-item">
                <a class="nav-link {{
                    active_class(\Request::is('admin/contact*'))
                }}" href="{{ route('blogs.index') }}">
                    <i class="nav-icon cil-envelope-closed"></i>
                    @lang('labels.menu.blogs')
                </a>
            </li>



            {{--<li class="divider"></li>--}}

            {{--@can('setting_management')--}}
                {{--<li class="nav-item nav-dropdown {{--}}
                    {{--active_class(Route::is('admin/auth*'), 'open')--}}
                {{--}}">--}}
                    {{--<a class="nav-link nav-dropdown-toggle {{--}}
                        {{--active_class(Route::is('admin/auth*'))--}}
                    {{--}}" href="#">--}}
                        {{--<i class="nav-icon cil-settings"></i>--}}
                        {{--@lang('labels.menu.setting_management')--}}
                    {{--</a>--}}
                    {{--<ul class="nav-dropdown-items">--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link nav-child {{--}}
                                {{--active_class(Route::is('admin/auth/user*'))--}}
                            {{--}}" href="{{ route('banks.edit') }}">--}}
                                {{--<i class="nav-icon cil-settings" aria-hidden="true"></i>--}}
                                {{--@lang('labels.menu.bank_management')--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--@endcan--}}

            @can('account_management')
                <li class="nav-item {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link" href="{{ route('accounts.index') }}">
                        <i class="nav-icon cil-contact"></i>
                        @lang('labels.menu.account_management')
                    </a>
                </li>
            @endcan
            {{--@endif--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
