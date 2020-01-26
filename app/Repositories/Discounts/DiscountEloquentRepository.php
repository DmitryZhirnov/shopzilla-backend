<?php

namespace App\Repositories\Discounts;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Collection;

class DiscountEloquentRepository implements DiscountRepositoryContract
{
    public function search(string $query = '', int $from = 0, int $size = 50): Array
    {
        if (empty($query))
            return Discount::all();
        return Discount::where('description', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->get();
    }

    public function favorites(): array
    {
        return [];
    }
}
