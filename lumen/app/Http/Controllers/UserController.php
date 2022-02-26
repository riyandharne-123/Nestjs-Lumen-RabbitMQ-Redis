<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Queue;

//models
use App\Models\User;

//jobs
use App\Jobs\PublishEmailsJob;

class UserController extends Controller
{

    public function __construct()
    {
        //
    }

    public function sendMails() {
        $users = User::select('id', 'name', 'email')->get()->random(10);

        Queue::push(new PublishEmailsJob([
            'users' => $users
        ]));
    }
}
