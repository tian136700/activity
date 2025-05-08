<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * 获取所有可报名的活动列表（未结束）
     */
    public function index()
    {
        $activities = Activity::with('admin:id,username')
            ->where('end_time', '>=', now())
            ->orderBy('start_time')
            ->get()
            ->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'description' => $activity->description,
                    'start_time' => $activity->start_time,
                    'end_time' => $activity->end_time,
                    'register_deadline' => $activity->register_deadline,
                    'location' => $activity->location,
                    'images' => $activity->images,
                    'status' => $activity->status,
                    'participant_limit' => $activity->participant_limit,
                    'admin_user' => $activity->admin->username ?? '未知',
                ];
            });

        return response()->json([
            'data' => $activities,
        ]);
    }

    /**
     * 获取单个活动详情
     */
    public function show($id)
    {
        $activity = Activity::with('admin:id,username')->findOrFail($id);

        return response()->json([
            'data' => [
                'id' => $activity->id,
                'title' => $activity->title,
                'description' => $activity->description,
                'start_time' => $activity->start_time,
                'end_time' => $activity->end_time,
                'register_deadline' => $activity->register_deadline,
                'location' => $activity->location,
                'images' => $activity->images,
                'status' => $activity->status,
                'participant_limit' => $activity->participant_limit,
                'admin_user' => $activity->admin->username ?? '未知',
            ]
        ]);
    }
}
