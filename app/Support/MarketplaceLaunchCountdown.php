<?php

namespace App\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

final class MarketplaceLaunchCountdown
{
    /**
     * @return array{
     *     launchConfigured: bool,
     *     launchPhrase: string|null,
     *     launchAtFormatted: string|null
     * }
     */
    public static function emailProps(?string $launchAt = null): array
    {
        $raw = $launchAt ?? (string) config('marketplace.launch_at', '');
        $raw = trim($raw);
        if ($raw === '') {
            return [
                'launchConfigured' => false,
                'launchPhrase' => null,
                'launchAtFormatted' => null,
            ];
        }

        $end = Carbon::parse($raw)->timezone(config('app.timezone'));
        $start = Carbon::now();

        return [
            'launchConfigured' => true,
            'launchPhrase' => self::buildPhrase($start, $end),
            'launchAtFormatted' => $end->isoFormat('MMMM D, YYYY'),
        ];
    }

    public static function buildPhrase(Carbon $start, Carbon $end): string
    {
        if ($end->lessThanOrEqualTo($start)) {
            return 'We are on the home stretch — launch is imminent. Watch your inbox for the next update.';
        }

        $totalSeconds = $end->getTimestamp() - $start->getTimestamp();
        if ($totalSeconds < 60) {
            return 'Launching in under a minute.';
        }

        $weeks = intdiv($totalSeconds, 604800);
        $totalSeconds %= 604800;
        $days = intdiv($totalSeconds, 86400);
        $totalSeconds %= 86400;
        $hours = intdiv($totalSeconds, 3600);
        $totalSeconds %= 3600;
        $minutes = intdiv($totalSeconds, 60);

        $parts = [];
        if ($weeks > 0) {
            $parts[] = $weeks.' '.Str::plural('week', $weeks);
        }
        if ($days > 0) {
            $parts[] = $days.' '.Str::plural('day', $days);
        }
        if ($hours > 0) {
            $parts[] = $hours.' '.Str::plural('hour', $hours);
        }
        if ($minutes > 0) {
            $parts[] = $minutes.' '.Str::plural('minute', $minutes);
        }

        if ($parts === []) {
            return 'Launching in under a minute.';
        }

        if (count($parts) === 1) {
            return 'Launching in '.$parts[0].'.';
        }

        $last = array_pop($parts);

        return 'Launching in '.implode(', ', $parts).' and '.$last.'.';
    }
}
