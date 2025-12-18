<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $contactData;

    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    public function build()
    {
        $address = config('mail.from.address');
        if (empty($address)) {
            $address = config('mail.username');
        }

        return $this->subject('Pesan Baru dari Website Desa Tegalsambi')
                    ->from($address, 'Website Desa')
                    ->replyTo($this->contactData['email'], $this->contactData['name'])
                    ->view('emails.contact');
    }
}
