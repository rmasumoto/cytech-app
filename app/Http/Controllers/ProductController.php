<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('company');

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $dataProducts = $query->get();

        return view('products.index', compact('dataProducts'));
    }

    public function show(int $id)
    {
        $dataProduct = Product::with('company')->findOrFail($id);
        $isLiked = Auth::check() ? Auth::user()->hasLiked($id) : false;

        return view('products.show', compact('dataProduct', 'isLiked'));
    }

    public function like(int $id)
    {
        $dataLike = new Like();
        $dataLike->toggle(Auth::id(), $id);

        return redirect()->route('products.show', $id);
    }
}
