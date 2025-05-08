<?php

namespace App\Filament\Resources\AdminApplicationResource\Pages;

use App\Filament\Resources\AdminApplicationResource;
use Filament\Resources\Pages\EditRecord;

class EditAdminApplication extends EditRecord
{
    protected static string $resource = AdminApplicationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['reviewed_at'] = now();
        $data['reviewer_id'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }


}
