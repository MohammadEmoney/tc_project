<?php

namespace App\Listeners;

use App\Events\NewRegisterPhone;
// use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\Generate;

class RegisteredPhone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels, Generate;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    // public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'REG';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewRegisterPhone $event)
    {
        return [
            'id' => $this->uniqueId($event->phone->id),
            'phone_number' => $event->phone->phone_number,
            'token' =>  $event->phone->token,
            'created_at' =>  $event->phone->created_at,
        ];
    }
}
