<?php

namespace App\Services;

use DeviceDetector\DeviceDetector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class MarketplaceLeadClientContext
{
    /**
     * @return array<string, mixed>
     */
    public static function for(Request $request): array
    {
        $userAgent = (string) $request->userAgent();
        $ip = $request->ip();

        $context = [
            'ip_address' => $ip ?: null,
            'user_agent' => $userAgent !== '' ? $userAgent : null,
            'device' => null,
            'operating_system' => null,
            'country_code' => self::cloudflareCountryCode($request),
            'country' => null,
            'city' => null,
            'region' => null,
            'latitude' => null,
            'longitude' => null,
        ];

        return $context;
    }

    /**
     * @param array<string, mixed> $context
     * @return array<string, mixed>
     */
    public static function enrich(array $context): array
    {
        if (!empty($context['user_agent'])) {
            self::applyUserAgent($context['user_agent'], $context);
        }

        if (config('marketplace.geo_lookup') === true && self::isPublicIp($context['ip_address'] ?? null)) {
            self::applyIpGeoLookup((string) $context['ip_address'], $context);
        }

        return $context;
    }

    private static function cloudflareCountryCode(Request $request): ?string
    {
        $code = $request->header('CF-IPCountry');
        if ($code === null || $code === '' || strtoupper($code) === 'XX') {
            return null;
        }

        return strtoupper(substr($code, 0, 2));
    }

    private static function isPublicIp(?string $ip): bool
    {
        if ($ip === null || $ip === '') {
            return false;
        }

        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private static function applyUserAgent(string $userAgent, array &$context): void
    {
        $detector = new DeviceDetector($userAgent);
        $detector->parse();

        if ($detector->isBot()) {
            $bot = $detector->getBot();
            $name = is_array($bot) ? ($bot['name'] ?? 'unknown') : 'unknown';
            $context['device'] = 'Bot: '.$name;

            return;
        }

        $parts = array_filter([
            $detector->getDeviceName() ?: null,
            $detector->getBrandName() ?: null,
            $detector->getModel() ?: null,
        ]);
        $context['device'] = $parts !== [] ? implode(' · ', $parts) : null;

        $osName = $detector->getOs('name');
        $osVersion = $detector->getOs('version');
        if ($osName !== null && $osName !== '' && $osName !== DeviceDetector::UNKNOWN) {
            $versionPart = ($osVersion !== null && $osVersion !== '' && $osVersion !== DeviceDetector::UNKNOWN) ? $osVersion : '';
            $context['operating_system'] = trim($osName.' '.$versionPart) ?: null;
        }
    }

    /**
     * Optional HTTPS lookup (ipapi.co). Enable with MARKETPLACE_GEO_LOOKUP=true.
     * Respect their fair-use limits; consider a paid GeoIP database for high volume.
     *
     * @param  array<string, mixed>  $context
     */
    private static function applyIpGeoLookup(string $ip, array &$context): void
    {
        try {
            // Reduced timeout to 1 second to prevent holding up the request
            $response = Http::timeout(1)
                ->acceptJson()
                ->get('https://ipapi.co/'.$ip.'/json/');

            if (! $response->successful()) {
                return;
            }

            $data = $response->json();
            if (! is_array($data) || isset($data['error']) || ! empty($data['reserved'])) {
                return;
            }

            if (! empty($data['country_code'])) {
                $context['country_code'] = strtoupper(substr((string) $data['country_code'], 0, 2));
            }
            if (! empty($data['country_name'])) {
                $context['country'] = (string) $data['country_name'];
            }
            if (! empty($data['city'])) {
                $context['city'] = (string) $data['city'];
            }
            if (! empty($data['region'])) {
                $context['region'] = (string) $data['region'];
            }
            if (isset($data['latitude'], $data['longitude'])) {
                $context['latitude'] = $data['latitude'];
                $context['longitude'] = $data['longitude'];
            }
        } catch (\Throwable) {
            // Geo is best-effort only.
        }
    }
}
