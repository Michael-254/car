<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Followup extends Mailable
{
    use Queueable, SerializesModels;
    
    public $follower;
    public $sender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($follower, User $sender)
    {
        $this->follower = $follower;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.FollowUp')
        ->subject('Follow Up Assignment');
    }
}
