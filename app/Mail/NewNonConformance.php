<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewNonConformance extends Mailable
{
    use Queueable, SerializesModels;
    
    public $auditor;
    public $auditee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($auditeeN, User $sender)
    {
        $this->auditee = $auditeeN;
        $this->auditor = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.Newnonconformance')
         ->subject('New Nonconformance Report');
    }
}
