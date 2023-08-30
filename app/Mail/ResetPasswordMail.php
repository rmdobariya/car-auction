<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build(): ResetPasswordMail
    {
        return $this->from('noreply@equsonline.com', config('mail.from.name'))
            ->with([
                'name' => $this->details['name'],
                'reset_password_body' => $this->details['reset_password_body'],
                'actionUrl' => $this->details['actionUrl'],
            ])
            ->subject($this->details['reset_password_subject'])
            ->markdown('emails.resetPassword');
    }
}
