<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarketplaceContactRequest;
use App\Mail\MarketplaceLeadConfirmation;
use App\Mail\MarketplaceLeadReceived;
use App\Models\MarketplaceLead;
use App\Services\MarketplaceLeadClientContext;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class MarketplaceContactController extends Controller
{
    public function __invoke(MarketplaceContactRequest $request): JsonResponse
    {
        $lead = MarketplaceLead::create([
            ...$request->validated(),
            'type' => 'contact',
            ...MarketplaceLeadClientContext::for($request),
            'metadata' => [
                'source' => 'marketplace_contact',
            ],
        ]);

        dispatch(function () use ($lead) {
            try {
                $this->notifyTeam($lead);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Failed to notify team: ' . $e->getMessage());
            }

            try {
                $this->sendConfirmation($lead);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send confirmation: ' . $e->getMessage());
            }
        })->afterResponse();

        return response()->json([
            'successTitle' => 'Thank you for contacting us.',
            'success' => 'We received your message and will reach out to you very soon.',
        ]);
    }

    private function notifyTeam(MarketplaceLead $lead): void
    {
        $recipients = config('marketplace.notification_emails');

        if (empty($recipients)) {
            return;
        }

        Mail::to($recipients)->send(new MarketplaceLeadReceived($lead));

        $lead->forceFill(['internal_notified_at' => now()])->save();
    }

    private function sendConfirmation(MarketplaceLead $lead): void
    {
        Mail::to($lead->email)->send(new MarketplaceLeadConfirmation($lead));

        $lead->forceFill(['confirmation_sent_at' => now()])->save();
    }
}
