<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HODNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $HOD;
    public $auditee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($HODMail, $auditee)
    {
        $this->HOD = $HODMail;
        $this->auditee = $auditee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.HODnotify')
        ->subject('New Nonconformance Report Review');
    }
}
