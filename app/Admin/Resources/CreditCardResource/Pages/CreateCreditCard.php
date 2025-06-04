<?php

declare(strict_types=1);

namespace App\Admin\Resources\CreditCardResource\Pages;

use App\Admin\Resources\CreditCardResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateCreditCard extends CreateRecord
{
    protected static string $resource = CreditCardResource::class;
}
