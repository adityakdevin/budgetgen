<?php

declare(strict_types=1);

namespace App\Admin\Resources\Goals\Pages;

use App\Admin\Resources\Goals\GoalResource;
use App\Admin\Resources\Goals\RelationManagers\ContributionsRelationManager;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

final class ManageGoals extends ManageRecords
{
    protected static string $resource = GoalResource::class;

    public static function getRelations(): array
    {
        return [
            ContributionsRelationManager::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
