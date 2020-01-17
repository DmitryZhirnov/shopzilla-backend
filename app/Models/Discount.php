<?php

namespace App\Models;

use App\Http\Resources\DiscountResource;
use Illuminate\Database\Eloquent\Model;

class Discount extends FavoritableBase
{
    use Searchable;

    protected $with  = ["category"];
    protected $casts = [
        'tags' => 'json'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toSearchArray()
    {
        return  (new DiscountResource($this))->toArray(null);
    }
}
