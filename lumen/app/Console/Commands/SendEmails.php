<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

//jobs
use App\Jobs\SendEmailsJob;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Amqp::consume('send-email-queue', function ($message, $resolver) {

            Queue::push(new SendEmailsJob([
                'email' => $message->body
            ]));

            $resolver->acknowledge($message);

        }, [
            'routing' => 'send-email',
            'exchange' => 'amq.direct',
            'exchange_type' => 'direct'
        ]);
    }
}
