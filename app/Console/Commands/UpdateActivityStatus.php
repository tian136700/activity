<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;
use Carbon\Carbon;

class UpdateActivityStatus extends Command
{
    protected $signature = 'activities:update-status';
    protected $description = '自动更新活动状态（未开始、进行中、已结束）';

    public function handle()
    {
        $now = Carbon::now();

        $activities = Activity::all();

        foreach ($activities as $activity) {
            $status = $activity->status;

            if ($now->lt($activity->start_time)) {
                $status = 0; // 未开始
            } elseif ($now->between($activity->start_time, $activity->end_time)) {
                $status = 1; // 进行中
            } elseif ($now->gt($activity->end_time)) {
                $status = 2; // 已结束
            }

            if ($activity->status !== $status) {
                $activity->update(['status' => $status]);
                $this->info("活动【{$activity->title}】状态已更新为：$status");
            }
        }

        return Command::SUCCESS;
    }
}
