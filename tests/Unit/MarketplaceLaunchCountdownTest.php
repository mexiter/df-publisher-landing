<?php

namespace Tests\Unit;

use App\Support\MarketplaceLaunchCountdown;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MarketplaceLaunchCountdownTest extends TestCase
{
    #[Test]
    public function it_formats_weeks_days_hours_and_minutes_with_and_before_last_part(): void
    {
        $start = Carbon::parse('2026-05-01 12:00:00');
        $end = Carbon::parse('2026-05-10 21:15:00'); // 9d 9h 15m

        $phrase = MarketplaceLaunchCountdown::buildPhrase($start, $end);

        $this->assertStringContainsString('1 week', $phrase);
        $this->assertStringContainsString('2 days', $phrase);
        $this->assertStringContainsString('9 hours', $phrase);
        $this->assertStringContainsString('15 minutes', $phrase);
        $this->assertStringContainsString(' and ', $phrase);
        $this->assertStringStartsWith('Launching in ', $phrase);
    }

    #[Test]
    public function it_returns_single_part_when_only_hours(): void
    {
        $start = Carbon::parse('2026-05-01 12:00:00');
        $end = Carbon::parse('2026-05-01 21:00:00');

        $phrase = MarketplaceLaunchCountdown::buildPhrase($start, $end);

        $this->assertSame('Launching in 9 hours.', $phrase);
    }

    #[Test]
    public function it_handles_past_launch(): void
    {
        $start = Carbon::parse('2026-06-01 12:00:00');
        $end = Carbon::parse('2026-05-01 12:00:00');

        $phrase = MarketplaceLaunchCountdown::buildPhrase($start, $end);

        $this->assertStringContainsString('home stretch', $phrase);
    }

    #[Test]
    public function email_props_are_empty_when_launch_not_configured(): void
    {
        config(['marketplace.launch_at' => null]);

        $props = MarketplaceLaunchCountdown::emailProps();

        $this->assertFalse($props['launchConfigured']);
        $this->assertNull($props['launchPhrase']);
    }
}
