<?php

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/** Buckets values per month (last 6 months) for charts; aggregation runs on Collections so it works on both MySQL and SQLite. */
class MonthlySeries
{
    /** @return array<string, string> 'Y-m' key => display label such as 'T11/2026' */
    public static function months(int $count = 6): array
    {
        $start = now()->startOfMonth()->subMonths($count - 1);

        return collect(range(0, $count - 1))->mapWithKeys(function (int $i) use ($start) {
            $month = $start->copy()->addMonths($i);

            return [$month->format('Y-m') => 'T'.$month->format('n/Y')];
        })->all();
    }

    public static function start(int $count = 6): CarbonInterface
    {
        return now()->startOfMonth()->subMonths($count - 1);
    }

    /**
     * @param  Collection<int, array{0: mixed, 1: float|int}>  $rows  [date, value] pairs
     * @return array<string, float> month label => total
     */
    public static function sum(Collection $rows, int $count = 6): array
    {
        $totals = array_fill_keys(array_keys(self::months($count)), 0.0);
        foreach ($rows as [$date, $value]) {
            $key = Carbon::parse($date)->format('Y-m');
            if (array_key_exists($key, $totals)) {
                $totals[$key] += (float) $value;
            }
        }

        return collect(self::months($count))->mapWithKeys(fn ($label, $key) => [$label => $totals[$key]])->all();
    }
}
