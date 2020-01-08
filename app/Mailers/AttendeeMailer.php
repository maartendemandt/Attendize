<?php

namespace App\Mailers;

use App\Models\Attendee;
use App\Models\Message;
use Carbon\Carbon;
use Log;
use Mail;


class AttendeeMailer extends Mailer
{

    public function sendAttendeeTicket($attendee)
    {

        Log::info("Sending attendee ticket to: " . $attendee->email);

        $data = [
            'attendee' => $attendee,
        ];

        Mail::send('Mailers.AttendeeMailer.AttendeeTicket', $data, function ($message) use ($attendee) {
            $message->to($attendee->email)
                ->from(config('attendize.outgoing_email_noreply'), $attendee->event->organiser->name)
                ->replyTo($attendee->event->organiser->email, $attendee->event->organiser->name)
                ->subject(trans("Email.your_ticket_for_event", ["event" => $attendee->order->event->title]));

            $file_name = $attendee->reference;
            $file_path = public_path(config('attendize.event_pdf_tickets_path')) . '/' . $file_name . '.pdf';

            $message->attach($file_path);
        });

    }

    /**
     * Sends the attendees a message
     *
     * @param Message $message_object
     */
    public function sendMessageToAttendees(Message $message_object, $sent_copy)
    {
        $event = $message_object->event;

        $attendees = ($message_object->recipients == 'all')
            ? $event->attendees // all attendees
            : Attendee::where('ticket_id', '=', $message_object->recipients)->where('account_id', '=',
                $message_object->account_id)->get();

        foreach ($attendees as $attendee) {
            
            if ($attendee->is_cancelled) {
               continue;
            }

            Log::info("Sending attendee message to: " . $attendee->email);
            
            $data = [
                'attendee'        => $attendee,
                'event'           => $event,
                'message_content' => $message_object->message,
                'subject'         => $message_object->subject,
                'email_logo'      => $attendee->event->organiser->full_logo_path,
            ];

            Mail::send('Mailers.AttendeeMailer.MessageToAttendees', $data, function ($message) use ($attendee, $data, $sent_copy) {
                $message->to($attendee->email, $attendee->full_name)
                    ->from(config('attendize.outgoing_email_noreply'), $attendee->event->organiser->name)
                    ->replyTo($attendee->event->organiser->email, $attendee->event->organiser->name)
                    ->subject($data['subject']);

                if($sent_copy) {
                    $message->bcc($attendee->event->organiser->email); 
                }
            });
        }

        $message_object->is_sent = 1;
        $message_object->sent_at = Carbon::now();
        $message_object->save();
    }

    public function SendAttendeeInvite($attendee)
    {

        Log::info("Sending attendee invite to: " . $attendee->email);

        $data = [
            'attendee' => $attendee,
        ];

        Mail::send('Mailers.AttendeeMailer.AttendeeInvite', $data, function ($message) use ($attendee) {
            $message->to($attendee->email)
                ->from(config('attendize.outgoing_email_noreply'), $attendee->event->organiser->name)
                ->replyTo($attendee->event->organiser->email, $attendee->event->organiser->name)        
                ->subject(trans("Email.your_ticket_for_event", ["event" => $attendee->order->event->title]));

            $file_name = $attendee->getReferenceAttribute();
            $file_path = public_path(config('attendize.event_pdf_tickets_path')) . '/' . $file_name . '.pdf';

            $message->attach($file_path);
        });

    }

    public function SendAttendeeCancelled($attendee)
    {
        Log::info("Sending attendee cancelled to: " . $attendee->email);

        $data = [
            'attendee' => $attendee,
        ];

        Mail::send('Mailers.AttendeeMailer.AttendeeCancelled', $data, function ($message) use ($attendee) {
            $message->to($attendee->email)
                ->from(config('attendize.outgoing_email_noreply'), $attendee->event->organiser->name)
                ->replyTo($attendee->event->organiser->email, $attendee->event->organiser->name)        
                ->subject(trans("Email.your_ticket_cancelled", ["event" => $attendee->order->event->title]));
        });

    }

    public function SendAttendeeRefunded($attendee)
    {

        Log::info("Sending refunded to: " . $attendee->email);

        $data = [
            'attendee' => $attendee,
        ];

        Mail::send('Mailers.AttendeeMailer.AttendeeRefunded', $data, function ($message) use ($attendee) {
            $message->to($attendee->email)
                ->from(config('attendize.outgoing_email_noreply'), $attendee->event->organiser->name)
                ->replyTo($attendee->event->organiser->email, $attendee->event->organiser->name)        
                ->subject(trans("Email.your_ticket_cancelled", ["event" => $attendee->order->event->title]));
        });

    }


}
