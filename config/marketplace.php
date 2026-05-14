<?php

return [
    'public_contact_email' => env('MARKETPLACE_PUBLIC_EMAIL', 'marketplace@dataflair.ai'),

    /*
     * Public launch moment for waitlist confirmation copy (ISO 8601 or strtotime()-compatible).
     * Used only when rendering the email — not a live clock in the client.
     * Example: 2026-06-01T09:00:00+00:00
     */
    'launch_at' => env('MARKETPLACE_LAUNCH_AT'),

    'notification_emails' => array_values(array_filter(array_map(
        static fn (string $email): string => trim($email),
        explode(',', env('MARKETPLACE_NOTIFY_EMAILS', ''))
    ))),

    /*
     * When true, performs a short HTTPS request to ipapi.co for public IPs to fill
     * country, city, region, and coordinates. Keep false unless you accept third-party
     * lookups and their rate limits; Cloudflare CF-IPCountry is still stored when present.
     */
    'geo_lookup' => filter_var(env('MARKETPLACE_GEO_LOOKUP', false), FILTER_VALIDATE_BOOLEAN),
];
