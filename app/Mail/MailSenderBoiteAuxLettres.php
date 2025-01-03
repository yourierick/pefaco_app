<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;

class MailSenderBoiteAuxLettres extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $attachmentPath;
    /**
     * Create a new message instance.
     */
    public function __construct($details, $attachmentPath)
    {
        $this->details = $details;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->details['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
            with: [
                'details' => $this->details,
            ],
        );
    }

    public function attachments()
    {
        if ($this->attachmentPath) {
            return [
                Attachment::fromPath(storage_path('app/public/'.$this->attachmentPath)),
            ];
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
}
