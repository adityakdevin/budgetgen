<?php

declare(strict_types=1);

namespace App\Admin\Resources\GoalResource\Pages;

use App\Admin\Resources\GoalResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateGoal extends CreateRecord
{
    protected static string $resource = GoalResource::class;
}
