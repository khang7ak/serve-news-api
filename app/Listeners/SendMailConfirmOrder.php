<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Post;

class SendMailConfirmOrder
{
    protected $post;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the event.
     *
     * @param  CustomerOrder  $event
     * @return void
     */
    public function handle(CustomerOrder $event)
    {
        $post = 

        Mail::to($event->bill->customer->email)
        ->send(new SubmitOrderMail($event->bill->customer, $event->bill));
    }
}
// composer require laravel/passport