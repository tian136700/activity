<?php

namespace App\Observers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


/**
 * 活动的观察器
 */
class ActivityObserver
{
    /**
     * Handle the Activity "created" event.
     */
    public function saving(Activity $activity): void
    {
        $now = Carbon::now();
        Log::info('11111');
        if ($activity->start_time && $activity->end_time) {
            $status = 0;

            if ($now->lt($activity->start_time)) {
                $status = 0; // 未开始
            } elseif ($now->between($activity->start_time, $activity->end_time)) {
                $status = 1; // 进行中
            } elseif ($now->gt($activity->end_time)) {
                $status = 2; // 已结束
            }

            // 避免死循环：仅当状态实际变化时才更新
            if ($activity->status !== $status) {
                $activity->updateQuietly(['status' => $status]);
            }
        }
    }

    /**
     * Handle the Activity "updated" event.
     */
    public function saved(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "deleted" event.
     */
    public function deleted(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "restored" event.
     */
    public function restored(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "force deleted" event.
     */
    public function forceDeleted(Activity $activity): void
    {
        //
    }


}
