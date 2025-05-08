<?php

namespace App\Filament\Resources\ActivityUserSignupResource\Pages;

use App\Filament\Resources\ActivityUserSignupResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageActivityUserSignups extends ManageRecords
{
    protected static string $resource = ActivityUserSignupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
