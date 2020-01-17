<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface SearchContract
{
    public function search(string $query = '', int $from = 0, int $size = 1000): Array;
}
