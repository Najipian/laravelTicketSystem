<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TickedUpdated extends Mailable
{
    use Queueable, SerializesModels;

    protected $comment , $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment = null , $type = 'tenant')
    {
        $this->comment = $comment;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ticket.update')
            ->with(
                [
                    'comment' => $this->comment ,
                    'type' => $this->type
                ]);
    }
}
