<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Property_Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
         $this->data = $data;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'hello@saakin.qa';
        $subject = 'Property Inquiry';
        $name = 'Saakin Qatar';

        return $this->view('emails.inquiry')
                    ->cc($this->data['user_email'], $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data ]);
    }
}
