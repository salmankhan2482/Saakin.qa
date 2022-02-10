<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Agent_Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
     public $data_email;

    public function __construct($data_email)
    {
        $this->data_email = $data_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $address = $this->data_email['email'];
        $subject = 'Agency Contact';
        $name = $this->data_email['name'];

        return $this->view('emails.contactAgent')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'data_email' => $this->data_email ]);
    }
}
