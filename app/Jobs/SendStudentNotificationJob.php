<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentNotificationMail;

class SendStudentNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $message;

    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function handle()
    {
        // Send the email using the Mail facade
        Mail::to($this->email)->send(new StudentNotificationMail($this->message));
    }
}
