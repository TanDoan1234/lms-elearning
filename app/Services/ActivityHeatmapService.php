<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class ActivityHeatmapService
{
    /** @param iterable<CarbonInterface|string|null> ...$sources */
    public function build(iterable ...$sources): Collection
    {
        $start = now()->startOfWeek()->subWeeks(11);
        $counts = collect($sources)
            ->flatten()
            ->filter()
            ->map(fn ($date) => $date instanceof CarbonInterface ? $date : Carbon::parse($date))
            ->filter(fn (CarbonInterface $date) => $date->betweenIncluded($start, now()->endOfDay()))
            ->countBy(fn (CarbonInterface $date) => $date->format('Y-m-d'));

        $positiveCounts = $counts->values()->filter(fn ($count) => $count > 0)->unique()->sort()->values();

        return collect(range(0, 83))->map(function (int $offset) use ($start, $counts, $positiveCounts) {
            $date = $start->copy()->addDays($offset);
            $count = (int) $counts->get($date->format('Y-m-d'), 0);
            $level = 0;
            if ($count > 0) {
                $level = $positiveCounts->count() === 1
                    ? 2
                    : max(1, (int) ceil((($positiveCounts->search($count) + 1) / $positiveCounts->count()) * 4));
            }

            return [
                'date' => $date->format('Y-m-d'),
                'label' => $date->translatedFormat('d/m/Y'),
                'count' => $count,
                'level' => $level,
            ];
        });
    }
}
