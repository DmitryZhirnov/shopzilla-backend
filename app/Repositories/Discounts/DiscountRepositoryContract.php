<?php

namespace App\Repositories\Discounts;

use App\Repositories\SearchContract;

interface DiscountRepositoryContract extends SearchContract
{
    public function favorites(): array;
}
