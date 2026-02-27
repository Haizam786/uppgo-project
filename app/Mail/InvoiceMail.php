<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdfUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdfUrl)
    {
        $this->pdfUrl = $pdfUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invoice-mail')
        ->subject('Your invoice PDF is ready!')
        ->with([
            'pdfUrl' => $this->pdfUrl,
        ]);
    }
}
