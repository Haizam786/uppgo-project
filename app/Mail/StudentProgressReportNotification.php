<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentProgressReportNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $reportId;
    public $createdAt;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @return void
     */
    public function __construct($name, $reportId, $createdAt)
    {
        $this->name = $name;
        $this->reportId = $reportId;
        $this->createdAt = $createdAt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.student_progress_report_notification');
    }
}
