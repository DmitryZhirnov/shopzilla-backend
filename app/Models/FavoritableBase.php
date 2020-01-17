<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritableBase extends Model
{
    protected $observables = [
        'favorited',
        'unfavorited',
    ];

    public function favorited()
    {
        $this->fireModelEvent('favorited', false);
    }

    public function unfavorited()
    {
        $this->fireModelEvent('unfavorited', false);
    }
}
