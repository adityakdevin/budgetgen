<?php

namespace App\Enums;

enum InvestmentType: string
{
    case STOCK = 'stock';
    case BOND = 'bond';
    case REAL_ESTATE = 'real_estate';
    case MUTUAL_FUND = 'mutual_fund';
    case CRYPTOCURRENCY = 'cryptocurrency';

    case INSURANCE = 'insurance';

}
