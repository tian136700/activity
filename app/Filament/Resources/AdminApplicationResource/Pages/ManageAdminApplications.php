<?php

namespace App\Filament\Resources\AdminApplicationResource\Pages;

use App\Filament\Resources\AdminApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAdminApplications extends ManageRecords
{
    protected static string $resource = AdminApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
