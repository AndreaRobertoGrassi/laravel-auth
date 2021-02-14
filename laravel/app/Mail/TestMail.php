<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $text;
    public function __construct($text= 'Hello')   
    {
        $this-> text=$text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-> from ('no-replay@boolean.careers') ->view('mail.testMail');
        
    }
}
