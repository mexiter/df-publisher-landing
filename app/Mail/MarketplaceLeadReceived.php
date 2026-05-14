<?php

namespace App\Mail;

use App\Models\MarketplaceLead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MarketplaceLeadReceived extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public MarketplaceLead $lead)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: sprintf(
                '[Marketplace] New %s lead: %s - %s',
                ucfirst($this->lead->type),
                $this->lead->email,
                $this->lead->displayRole()
            )
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.marketplace.lead-received',
            text: 'emails.marketplace.lead-received-text',
            with: [
                'lead' => $this->lead,
            ],
        );
    }
}
