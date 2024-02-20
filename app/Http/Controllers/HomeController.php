<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $products = Product::query()
            ->when(request()->input('sizes'), function (Builder $query) {
                $query->whereHas('sizes', function (Builder $query) {
                    $query->whereIn('sizes.id', request()->input('sizes'));
                });
            })
            ->when(request()->input('categories'), function (Builder $query,$categories) {
                    $query->whereIn('category_id', $categories);
            })
            ->when(request()->input('sort'), function (Builder $query, $sort) {
                if ($sort == 'latest') {
                    $query->orderByDesc('created_at');
                } elseif ($sort == 'ascending') {
                    $query->orderBy('price');
                } elseif ($sort == 'descending') {
                    $query->orderByDesc('price');
                }
            })
            ->get();


        $sizes = Size::all();
        $categories = Category::all();
        $cartProducts = CartResource::collection(
            Cart::query()
                ->where('session_id', session()
                    ->getId()
                )
                ->get()

        );

        $cartTotal = Cart::cartTotal();

        return Inertia::render('Users/Home', compact(
            'products',
            'sizes',
            'categories',
            'cartProducts',
            'cartTotal',

        ));


    }


}
