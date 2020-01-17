<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Searchable;

    protected $casts = [
        'tags' => 'json'
    ];

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function toSearchArray()
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "image_url" => $this->image_url
        ];
    }
}
