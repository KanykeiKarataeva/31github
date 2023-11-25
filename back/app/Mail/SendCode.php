<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public int $code = 0;

    public function __construct(int $code)
    {
        $this->code = $code;
    }


    public function build()
    {   $code = $this->code;
        return $this->from('bekwebdeveloper@gmail.com', 'Email verification!')
            ->view('emails.sendCode', compact('code'));
    }
}
