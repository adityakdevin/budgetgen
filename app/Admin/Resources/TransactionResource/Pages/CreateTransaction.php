<?php

declare(strict_types=1);

namespace App\Admin\Resources\TransactionResource\Pages;

use App\Admin\Resources\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
}
