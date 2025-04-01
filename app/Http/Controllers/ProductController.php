<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use App\Services\PhotoService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected PhotoService $photoService;
    public function __construct(ProductService $productService, PhotoService $photoService){
        $this->productService = $productService;
        $this->photoService = $photoService;
    }
    public function add() : object
    {
        return view('addProduct');
    }

    public function store(Request $request) : object
    {
        $this->productService->validate($request);

        DB::transaction(function () use ($request) {
            $product = $this->productService->create($request);
            // Обработка фотографий
            $this->photoService->create($request, $product);
        });

        return redirect('/profile/' . Session::get('user')->id);
    }

    public function edit(int $id) : object{
        return view('editProduct', ['product' => Product::query()->find($id)]);
    }
    public function update(Request $request, int $id) : object{
        $this->productService->validate($request);
        $this->productService->update($request, $id);

        return redirect('/profile/' . Session::get('user')->id);
    }
    public function delete(int $id) : object{

        $product = Product::all()->findOrFail($id);

        if (!$product)  return redirect('/products');

        $this->photoService->delete($product);

        $product->delete();

        return redirect('/profile/' . Session::get('user')->id);
    }
}
