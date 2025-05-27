<?php

namespace App\Admin\Resources\GoalResource\Pages;

use App\Admin\Resources\GoalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGoal extends CreateRecord
{
    protected static string $resource = GoalResource::class;
}
