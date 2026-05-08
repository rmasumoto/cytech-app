<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataUser = Auth::user()->load('company');
        $dataListedProducts = Product::where('user_id', $dataUser->id)->get();
        $dataPurchasedProducts = $dataUser->sales()->with('product')->get();

        return view('mypage.index', compact('dataUser', 'dataListedProducts', 'dataPurchasedProducts'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'stock'        => 'required|integer|min:0',
            'img_path'     => 'nullable|image|max:2048',
        ]);

        $dataUser = Auth::user();
        $imgPath = null;

        if ($request->hasFile('img_path')) {
            $imgPath = $request->file('img_path')->store('products', 'public');
        }

        Product::create([
            'user_id'      => $dataUser->id,
            'company_id'   => $dataUser->company_id,
            'product_name' => $request->product_name,
            'price'        => $request->price,
            'description'  => $request->description,
            'stock'        => $request->stock,
            'img_path'     => $imgPath,
        ]);

        return redirect()->route('mypage.index');
    }

    public function showProduct(int $id)
    {
        $dataProduct = Product::where('user_id', Auth::id())->findOrFail($id);
        return view('products.show_listed', compact('dataProduct'));
    }

    public function destroyProduct(int $id)
    {
        $dataProduct = Product::where('user_id', Auth::id())->findOrFail($id);

        if ($dataProduct->img_path) {
            Storage::disk('public')->delete($dataProduct->img_path);
        }

        $dataProduct->delete();

        return redirect()->route('mypage.index');
    }

    public function editProduct(int $id)
    {
        $dataProduct = Product::where('user_id', Auth::id())->findOrFail($id);
        return view('products.edit', compact('dataProduct'));
    }

    public function updateProduct(Request $request, int $id)
    {
        $dataProduct = Product::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'stock'        => 'required|integer|min:0',
            'img_path'     => 'nullable|image|max:2048',
        ]);

        $imgPath = $dataProduct->img_path;

        if ($request->hasFile('img_path')) {
            if ($imgPath) {
                Storage::disk('public')->delete($imgPath);
            }
            $imgPath = $request->file('img_path')->store('products', 'public');
        }

        $dataProduct->update([
            'product_name' => $request->product_name,
            'price'        => $request->price,
            'description'  => $request->description,
            'stock'        => $request->stock,
            'img_path'     => $imgPath,
        ]);

        return redirect()->route('mypage.index');
    }
}
