<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mymail extends Mailable
{
    use Queueable, SerializesModels;
    public $slot;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($slot)
    {
        $this->slot=$slot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@sahariar.com')
                    ->view('mail.notify');
    }
}
