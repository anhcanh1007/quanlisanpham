<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ProductController extends Controller
{
    public function index()
    {
        $pro = Product::with('category')->orderBy('products.id')->get();
        return view('admin.products.list', compact('pro'));
    }
    public function showAdd()
    {
        $cate = Category::all();
        return view('admin.products.create', compact('cate'));
    }
    public function destroy($id)
    {
        $pro = Product::find($id);
        $pro->delete();
        return redirect()->route('list_product');
    }
    public function edit($id)
    {
        $cate = Category::all();
        $pro = Product::find($id);
        return view('admin.products.edit', compact('pro', 'cate'));
    }
    public function update(Request $request, $id)
    {
        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $file_name = $file->getClientoriginalName();
            $file->move(public_path('images'), $file_name);
        }
        $request->merge(['image' => $file_name]);
        $pro = Product::find($id);
        $pro->update($request->all());
        return redirect()->route('list_product');
    }

    public function getImages($id)
    {
        $product = Product::with('images')->where('products.id', $id)->first();

        return view('admin.products.list_image', compact('product'));
    }
}