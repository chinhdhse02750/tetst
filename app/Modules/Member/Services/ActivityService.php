<?php

namespace App\Modules\Member\Services;

use App\Jobs\MailJob;
use Illuminate\Mail\Mailable;

class ActivityService
{

    public function send(Mailable $mailable)
    {
        MailJob::dispatch($mailable)->onQueue(QUEUE_MEDIUM);
    }
}
