<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Repositories\Discounts\DiscountRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request, DiscountRepositoryContract $repository) {
    $discounts = $repository->search(strval(""));
    return view('discounts', ['discounts' => $discounts["items"]]);
});

Route::get('/discounts', function (Request $request, DiscountRepositoryContract $repository) {
    if (empty($request->from) && empty($request->size))
        $discounts = $repository->search(strval($request["query"]));
    else
        $discounts = $repository->search(strval($request['query']), $request['from'], $request['size']);
    return view('discounts', ['discounts' => $discounts['items']]);
});
