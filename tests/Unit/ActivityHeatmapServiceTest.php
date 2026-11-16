<?php

namespace Tests\Unit;

use App\Services\ActivityHeatmapService;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ActivityHeatmapServiceTest extends TestCase
{
    public function test_it_builds_84_days_and_combines_activity_sources(): void
    {
        Carbon::setTestNow('2026-11-16 12:00:00');

        $days = app(ActivityHeatmapService::class)->build(
            [now(), now()->subDay()],
            [now(), now()->subDays(90)]
        );

        $this->assertCount(84, $days);
        $today = $days->firstWhere('date', '2026-11-16');
        $yesterday = $days->firstWhere('date', '2026-11-15');
        $this->assertSame(2, $today['count']);
        $this->assertSame(4, $today['level']);
        $this->assertSame(1, $yesterday['count']);
        $this->assertSame(2, $yesterday['level']);

        Carbon::setTestNow();
    }
}
