<?php

namespace App\Modules\Member\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotifyNewOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $orderContent;

    protected $dataGuest;

    /**
     * SendNotifyToMember constructor.
     *
     * @param $data
     */
    public function __construct($orderContent, $dataGuest)
    {
        $this->orderContent = $orderContent;
        $this->dataGuest = $dataGuest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userEmail = $this->dataGuest['email'];
        $adminEmail = env('MAIL_TO_ADMIN');
        $subject = 'Thông Báo Tiếp Nhận Đơng Hàng';

        return $this
            ->to($userEmail)
            ->cc($adminEmail)
            ->subject($subject)
            ->markdown('emails.order.new_order')
            ->with([
                'orderContent' => $this->orderContent,
                'dataGuest' => $this->dataGuest,
            ]);
    }
}
