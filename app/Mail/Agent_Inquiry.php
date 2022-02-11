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


        $address = 'hello@saakin.qa';
        $subject = 'Contact Agency';
        $name = 'Saakin Qatar';

        return $this->view('emails.contactAgent')
                    ->cc($this->data_email['email'], $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'data_email' => $this->data_email ]);
    }
}
