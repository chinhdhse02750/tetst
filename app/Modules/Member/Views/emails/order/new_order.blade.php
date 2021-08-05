@component('mail::message')
Xin chào {{$dataGuest['full_name']}}

<p>Đơn hàng: {{$orderContent['name']}}</p>
<p>Số lương: {{$orderContent['qty']}}</p>
<p>Đã đặt hàng thành công.</p>
<p>Chúng tôi sẽ sớm gửi hàng đến chỉ {{$dataGuest['address']}} trong thời gian sớm nhất.</p>
<p>Cảm ơn bạn đã ủng hộ chúng tôi. Xin chân thành cảm ơn!!</p>
@endcomponent
