<?php

declare(strict_types=1);

namespace App\Admin\Resources\Goals\Pages;

use App\Admin\Resources\Goals\GoalResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateGoal extends CreateRecord
{
    protected static string $resource = GoalResource::class;
}
