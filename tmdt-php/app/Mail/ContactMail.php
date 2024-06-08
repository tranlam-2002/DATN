<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact')
                    ->subject('New Contact Message')
                    ->with([
                        'email' => $this->contactMessage->email,
                        'messageContent' => $this->contactMessage->message,
                    ])
                    ;
    }
}