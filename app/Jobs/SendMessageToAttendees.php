<?php

namespace App\Jobs;

use App\Mailers\AttendeeMailer;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageToAttendees extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $attendeeMessage;
    public $sent_copy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Message $attendeeMessage, $sent_copy = false)
    {
        $this->attendeeMessage = $attendeeMessage;
        $this->sent_copy = $sent_copy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AttendeeMailer $attendeeMailer)
    {
        $attendeeMailer->sendMessageToAttendees($this->attendeeMessage, $this->sent_copy);
    }
}
