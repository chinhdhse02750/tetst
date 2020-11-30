@if($breadcrumbs)
    <div class="ogami-breadcrumb">
        <div class="container">
            <ul>
            @foreach($breadcrumbs as $breadcrumb)
                @if($breadcrumb->url && !$loop->last)
                    <li><a class="breadcrumb-link" href="{{ $breadcrumb->url }}"> <i
                                class="fas fa-home"></i>{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-link active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
            @yield('breadcrumb-links')
            </ul>
        </div>
    </div>
@endif
