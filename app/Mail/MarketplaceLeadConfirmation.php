<?php

namespace App\Mail;

use App\Models\MarketplaceLead;
use App\Support\MarketplaceLaunchCountdown;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MarketplaceLeadConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public MarketplaceLead $lead)
    {
    }

    public function envelope(): Envelope
    {
        $subject = $this->lead->type === 'waitlist'
            ? 'You are on the DataFlair Marketplace waitlist'
            : 'Thank you for contacting DataFlair Marketplace';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.marketplace.lead-confirmation',
            text: 'emails.marketplace.lead-confirmation-text',
            with: [
                'lead' => $this->lead,
                ...MarketplaceLaunchCountdown::emailProps(),
            ],
        );
    }
}
