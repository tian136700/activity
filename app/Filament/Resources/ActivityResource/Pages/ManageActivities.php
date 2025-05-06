<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageActivities extends ManageRecords
{
    protected static string $resource = ActivityResource::class;

    /**
     * 给标签页分类
     * @return array|\Filament\Resources\Components\Tab[]
     *
     */
    public function getTabs(): array
    {
        return [
            '未开始' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 0)),
            '进行中' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 1)),
            '已结束' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 2)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
