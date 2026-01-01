<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function build()
    {
        return $this->subject('Seu empréstimo está para vencer')
            ->markdown('emails.loan_reminder');
    }
}