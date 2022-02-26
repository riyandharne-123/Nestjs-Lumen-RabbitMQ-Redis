<?php

namespace App\Jobs;

use Bschmitt\Amqp\Amqp;

class PublishEmailsJob extends Job
{
    protected $data;
    protected $amqp;

    public function __construct($data)
    {
        $this->data = $data;
        $this->amqp = new Amqp();
    }

    public function handle()
    {
        $users = $this->data['users'];

        foreach($users as $user) {

            $this->amqp->publish('publish-email', json_encode($user), [
                'queue' => 'publish-email-queue',
                'exchange' => 'amq.direct',
                'exchange_type' => 'direct'
            ]);

            echo 'email pushed to queue for ' . $user->email . PHP_EOL;

        }
    }
}
