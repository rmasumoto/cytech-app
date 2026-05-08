<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $id)
    {
        $dataProduct = Product::with('company')->findOrFail($id);
        return view('products.purchase', compact('dataProduct'));
    }

    public function store(Request $request, int $id)
    {
        $dataProduct = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $dataProduct->stock,
        ]);

        DB::transaction(function () use ($dataProduct, $request) {
            $dataSale = new Sale();
            $dataSale->recordPurchase(Auth::id(), $dataProduct->id, $request->quantity);

            $dataProduct->decrement('stock', $request->quantity);
        });

        return redirect()->route('products.index');
    }
}
