<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;

class SendEmailsJob extends Job
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $emailData = json_decode($this->data['email']);

        Mail::to($emailData->email)->send(new UserMail([
            'email' => $emailData
        ]));

        echo 'email sent for user ' . $emailData->email . PHP_EOL;
    }
}
