<?php

namespace App\Jobs;

use App\Mail\MailSenderBoiteAuxLettres;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class SendMailBoiteAuxLettreJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $recipient;
    public $details;
    public $filePath;
    /**
     * Create a new job instance.
     */
    public function __construct($recipient, $details, $filePath)
    {
        $this->recipient = $recipient;
        $this->details = $details;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->recipient)->send(new MailSenderBoiteAuxLettres($this->details, $this->filePath));

        if ($this->filePath && Storage::disk('public')->exists($this->filePath)) {
            Storage::disk('public')->delete($this->filePath);
        }
    }
}
