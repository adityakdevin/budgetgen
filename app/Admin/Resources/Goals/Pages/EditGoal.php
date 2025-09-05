<?php

declare(strict_types=1);

namespace App\Admin\Resources\Goals\Pages;

use App\Admin\Resources\Goals\GoalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditGoal extends EditRecord
{
    protected static string $resource = GoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
