<?php

namespace App\Modules\Member\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotifyNewOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * SendNotifyToMember constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $adminMail = explode(',', env('MAIL_TO_ADMIN'));
        $subject = '[Order] Has New Order';

        return $this
            ->to($adminMail)
            ->subject($subject)
            ->markdown('emails.order.new_order')
            ->with([
                'content' => $this->data,
            ]);
    }
}
