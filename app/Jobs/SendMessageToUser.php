<?php

namespace App\Jobs;

use App\Mailers\UserMailer;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageToUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $data;
    public $sent_copy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $sent_copy = false)
    {
        $this->data = $data;
        $this->sent_copy = $sent_copy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserMailer $userMailer)
    {
        $userMailer->sendMessageToUser($this->data, $this->sent_copy);
    }
}
