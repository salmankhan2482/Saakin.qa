<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgencyRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $inputs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->inputs = $inputs; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $address = 'webmaster@saakin.qa';
        $subject = 'Account Created Successfully';
        $name = 'Saakin Qatar';

        return $this->view('emails.AgencyRegisterMail')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with('inputs', $this->inputs);

    }
}
