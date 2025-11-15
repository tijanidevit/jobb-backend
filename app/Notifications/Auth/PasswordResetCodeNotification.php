<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Password Reset Request')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Use the password reset code below:')
            ->line('')
            ->line('**'.$this->token.'**')
            ->line('')
            ->line('This code will expire in **1 hour**.')
            ->line('If you didn’t request a password reset, ignore this message.')
            ->salutation('The '.config('app.name').' Team');
    }
}
