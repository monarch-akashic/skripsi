<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewSchedule extends Mailable
{
    use Queueable, SerializesModels;

    public $interview;
    public $vacancy;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($interview, $vacancy)
    {
        $this->interview = $interview;
        $this->vacancy = $vacancy;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from sidejobsite.com')->markdown('emails.InterviewSchedule')->with(['interview' => $this->interview, 'vacancy' => $this->vacancy]);
    }
}
