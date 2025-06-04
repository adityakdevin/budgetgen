<?php

declare(strict_types=1);

namespace App\Admin\Resources\GoalResource\Pages;

use App\Admin\Resources\GoalResource;
use App\Admin\Resources\GoalResource\RelationManagers;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

final class ManageGoals extends ManageRecords
{
    protected static string $resource = GoalResource::class;

    public static function getRelations(): array
    {
        return [
            RelationManagers\ContributionsRelationManager::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
