<?php

namespace Tests\Feature;

use App\Mail\MarketplaceLeadConfirmation;
use App\Mail\MarketplaceLeadReceived;
use App\Models\MarketplaceLead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MarketplaceLeadTest extends TestCase
{
    use RefreshDatabase;

    private const SAMPLE_CHROME_WINDOWS_UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';

    public function test_waitlist_submission_is_stored_and_emails_are_sent(): void
    {
        Mail::fake();

        config()->set('marketplace.notification_emails', [
            'owner@example.com',
            'partner@example.com',
        ]);

        $response = $this->withHeaders([
            'User-Agent' => self::SAMPLE_CHROME_WINDOWS_UA,
            'CF-IPCountry' => 'DE',
        ])->post('/waitlist', [
            'role' => 'advertiser',
            'email' => 'lead@example.com',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['successTitle' => 'Thank you for joining our waitlist.']);
        $this->assertDatabaseHas('marketplace_leads', [
            'type' => 'waitlist',
            'role' => 'advertiser',
            'email' => 'lead@example.com',
            'country_code' => 'DE',
        ]);

        $lead = MarketplaceLead::query()->where('email', 'lead@example.com')->first();
        $this->assertNotNull($lead->ip_address);
        $this->assertStringContainsString('Chrome', (string) $lead->user_agent);
        $this->assertNotNull($lead->device);
        $this->assertNotNull($lead->operating_system);

        Mail::assertSent(MarketplaceLeadReceived::class);
        Mail::assertSent(MarketplaceLeadConfirmation::class, function ($mail) {
            return $mail->hasTo('lead@example.com');
        });
    }

    public function test_waitlist_geo_lookup_fills_location_when_enabled(): void
    {
        Mail::fake();
        config()->set('marketplace.notification_emails', ['owner@example.com']);
        config()->set('marketplace.geo_lookup', true);

        Http::fake(function (\Illuminate\Http\Client\Request $request) {
            if (str_contains($request->url(), 'ipapi.co/203.0.113.50')) {
                return Http::response([
                    'country_code' => 'US',
                    'country_name' => 'United States',
                    'city' => 'Example City',
                    'region' => 'Example Region',
                    'latitude' => 40.7128,
                    'longitude' => -74.0060,
                ], 200);
            }

            return Http::response(['error' => true], 404);
        });

        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.50'])
            ->withHeaders(['User-Agent' => self::SAMPLE_CHROME_WINDOWS_UA])
            ->post('/waitlist', [
                'role' => 'publisher',
                'email' => 'geo@example.com',
            ]);

        $this->assertDatabaseHas('marketplace_leads', [
            'email' => 'geo@example.com',
            'country_code' => 'US',
            'country' => 'United States',
            'city' => 'Example City',
            'region' => 'Example Region',
        ]);

        $lead = MarketplaceLead::query()->where('email', 'geo@example.com')->first();
        $this->assertEqualsWithDelta(40.7128, (float) $lead->latitude, 0.0001);
        $this->assertEqualsWithDelta(-74.006, (float) $lead->longitude, 0.0001);
    }

    public function test_contact_submission_is_stored_and_emails_are_sent(): void
    {
        Mail::fake();

        config()->set('marketplace.notification_emails', [
            'owner@example.com',
            'partner@example.com',
        ]);

        $response = $this->withHeaders([
            'User-Agent' => self::SAMPLE_CHROME_WINDOWS_UA,
        ])->post('/contact', [
            'role' => 'publisher',
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'I want to discuss publisher inventory.',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['successTitle' => 'Thank you for contacting us.']);
        $this->assertDatabaseHas('marketplace_leads', [
            'type' => 'contact',
            'role' => 'publisher',
            'email' => 'jane@example.com',
        ]);

        $lead = MarketplaceLead::query()->where('email', 'jane@example.com')->first();
        $this->assertNotNull($lead->ip_address);
        $this->assertNotNull($lead->device);

        Mail::assertSent(MarketplaceLeadReceived::class);
        Mail::assertSent(MarketplaceLeadConfirmation::class, function ($mail) {
            return $mail->hasTo('jane@example.com');
        });
    }
}
