<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\sendMail;
use App\User;


class sendMailEveryDay extends Command
{
    // protected $user;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail sẽ được gửi hàng ngày';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->user = $user;

        // dd($user);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::getLists();
        // Mail::to($user)->send(new sendMail($user));
        
        foreach ($users as $user) {
            $email = new sendMail($user);
            Mail::to($user->email)->send($email);
        }

        // return 0;
    }
}
