<?php

declare(strict_types=1);

namespace App\Admin\Resources\Goals\Pages;

use App\Admin\Resources\Goals\GoalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListGoals extends ListRecords
{
    protected static string $resource = GoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
