<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;

class SendCampaignOffer extends Notification
{
    use Queueable;
    protected $emailContent;

    /**
     * Create a new notification instance.
     */
    public function __construct($emailContent)
    {
        $this->emailContent = $emailContent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // dd($this->emailContent);
        $user= auth()->user()->role_id;
        $action = $user == "Brand" ? "View Campaign" : "View Profile";
        return (new MailMessage())
            ->subject($this->emailContent['subject'])
            ->line(new HtmlString($this->emailContent['emailContent']))
            ->action($action, $this->emailContent['url'] );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
