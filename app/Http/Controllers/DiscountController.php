<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use App\Repositories\Discounts\DiscountRepositoryContract;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DiscountRepositoryContract $repository)
    {
        info($request);
        $query = empty($request['query']) ? '' : $request['query'];
        if (empty($request->from) || empty($request->size))
            $response = $repository->search($query);
        else
            $response = $repository->search($query, $request->from, $request->size);

        return $response;
    }

    /**
     * Добавление акции в избранное
     */
    public function favorite(Request $request)
    {
        $discount = Discount::whereId($request->id)->first();
        $discount->favorited();
    }

    /**
     * Уадление из избранного акции в избранное
     */
    public function unfavorite(Request $request)
    {
        $discount = Discount::whereId($request->id)->first();
        $discount->unfavorited();
    }

    public function favorites(DiscountRepositoryContract $repository)
    {
        return $repository->favorites();
    }
}
