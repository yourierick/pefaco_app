<?php

namespace App\Jobs;

use App\Mail\MailSender;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class PrincipalSendMailJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $recipients;
    public $details;
    public $filePath;
    /**
     * Create a new job instance.
     */
    public function __construct($recipients, $details, $filePath)
    {
        $this->recipients = $recipients;
        $this->details = $details;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->recipients as $recipient) {
            Mail::to($recipient)->send(new MailSender($this->details, $this->filePath));
        }

        if ($this->filePath && Storage::disk('public')->exists($this->filePath)) {
            Storage::disk('public')->delete($this->filePath);
        }
    }
}
