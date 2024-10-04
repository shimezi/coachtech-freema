<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent; // メッセージ内容を保持
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $message)
    {
        $this->user = $user;
        $this->messageContent = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('お知らせ')
            ->view('emails.user_notification')
            ->with([
                'mailMessage' => $this->messageContent,
                'user' => $this->user,
            ]);
    }
}
