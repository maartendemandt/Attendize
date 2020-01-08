<?php

/*
  Attendize.com   - Event Management & Ticketing
 */

use Log;
use Mail;

/**
 * Description of UserMailer.
 *
 * @author Dave
 */
class UserMailer
{

    public function sendMessageToUser($data, $sent_copy)
    {

        Log::info("Sending attendee ticket to: " . $data['order']->email);

        Mail::send('Mailers.UserMailer.MessageToUser', $data, function ($message) use ($data, $sent_copy) {
            $message->to($data['order']->email, $data['order']->full_name)
                ->from(config('attendize.outgoing_email_noreply'), $data['order']->event->organiser->name)
                ->replyTo($data['order']->event->organiser->email, $data['order']->event->organiser->name)
                ->subject($data['subject']);
          
            if($sent_copy) {
                $message->bcc($data['order']->event->organiser->email); 
            }
        });

        
    }
}
