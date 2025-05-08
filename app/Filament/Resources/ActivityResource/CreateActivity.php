<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateActivity extends CreateRecord
{
    protected static string $resource = ActivityResource::class;

    // 如果你要在创建后处理图片数据等，可以在这里写逻辑
    protected function afterCreate(): void
    {
        $images = $this->data['images'] ?? [];

        foreach ($images as $path) {
            $this->record->images()->create([
                'image_path' => $path,
            ]);
        }
    }
}
