<?php

declare(strict_types=1);

namespace App\Admin\Resources\CreditCards\Pages;

use App\Admin\Resources\CreditCards\CreditCardResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateCreditCard extends CreateRecord
{
    protected static string $resource = CreditCardResource::class;
}
