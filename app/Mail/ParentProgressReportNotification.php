<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParentProgressReportNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $parentName; // Define the variable for the parent's name
    public $reportId;
    public $createdAt;
    public $name;
    /**
     * Create a new message instance.
     *
     * @param string $parentName
     * @return void
     */
    public function __construct($parentName, $reportId, $createdAt,$name)
    {
        $this->parentName = $parentName;
        $this->reportId = $reportId;
        $this->createdAt = $createdAt;
        $this->name = $name;
    }

    /**
     * Build the message.
     * 
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.parent_progress_report_notification');
    }
}
