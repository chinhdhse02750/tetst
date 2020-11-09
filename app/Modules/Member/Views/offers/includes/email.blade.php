<!DOCTYPE html>
<html>
<head>
    <title>Confirm Offer</title>
</head>
<body>

<p>@lang('offers.label.email_des')</p>
<p>@lang('users.label.email') : {{ $user->email }}.</p>
<p>@lang('users.label.member_id') : {{ $user->id }}.</p>
<p>@lang('offers.label.offer_detail_url') : <a href="{{ url("/admin/offers/".$idOffer) }}">{{ $idOffer }}.</a></p>
<p>@lang('offers.label.date_sent') : {{ $now }}.</p>
<p>@lang('offers.label.payment_method') :
    @foreach($settingMember['payment_method'][App::getLocale()] as $key => $value)
        @if($key === (int)$dataOffer['payment_method'])
            {{ $value }}
        @endif
    @endforeach .</p>
</body>
</html>
