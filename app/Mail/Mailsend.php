<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $url)
    {
        $this->details = $details;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verifikasi Akun')
            ->markdown('mail.verify_email_template');
    }

    public function attachments()
    {
        return [];
    }
}
