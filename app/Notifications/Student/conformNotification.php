<?php

namespace App\Notifications\student;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Event;
use App\Student;

class conformNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $event_id = $notifiable->event_id;
        $team_id = $notifiable->team_id;
        $enrollment_no = $notifiable->enrollment_no;
        $event = Event::where('id', $event_id)
            ->first();
        $leader = Student::where('stu_enrollment_no', $team_id)
            ->first();
        $event_name = $event->event_name;
        $leader_name = $leader->stu_name;
        $leader_enrollment_no = $leader->stu_enrollment_no;
        return (new MailMessage)
                    ->line('you invated for participet '.$event_name.' event')
                    ->line('your team leader is '.$leader_name)
                    // ->action('Accept', route('student.accept',[$event_id,$team_id,$enrollment_no,$leader_enrollment_no]))
                    ->action('Accept', route('student.accept',compact('event_id','team_id','enrollment_no','leader_enrollment_no')))
                    ->line('you invated for participet this event');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
