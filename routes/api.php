<?php

use App\Http\Controllers\DiscountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["middleware" => "auth:api"], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/orders', function () {

        $orders = [
            [
                'id' => 1,
                'agencyName' => 'Agency 1',
                'brandName' => 'Brand 1'
            ]
        ];
        return response()->json($orders);
    });

    Route::get('/discounts/favorites' , 'DiscountController@favorites')->name('discounts-favorites');
    Route::post('/discounts/favorite' , 'DiscountController@favorite')->name('discount-favorite');
    Route::post('/discounts/unfavorite' , 'DiscountController@unfavorite')->name('discount-unfavorite');
});
Route::get('/discounts', 'DiscountController@index')->name('discounts-search');
