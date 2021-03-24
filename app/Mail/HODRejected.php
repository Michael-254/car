<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HODRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $auditee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($auditee, User $sender)
    {
        $this->auditee = $auditee;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.HODrejected')
        ->subject('Rejected CAR');
    }
}
