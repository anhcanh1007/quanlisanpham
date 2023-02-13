<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Product_Tag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ProductController extends Controller
{
    public function index()
    {
        $pro = Product::with('category', 'tags')->orderBy('products.id')->get();

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


    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  $id
     * @return \Illuminate\Auth\Access\Response
     */
    public function edit($id)
    {
        $cate = Category::all();
        $pro = Product::with('images', 'tags')->where('products.id', $id)->first();
        return view('admin.products.edit', compact('pro', 'cate'));
    }


    public function update(Request $request)
    {
        //update product
        $pro = Product::with('tags', 'images', 'product_tags')->where('products.id', $request->id)->first();
        // dd($pro);
        if ($request->has('file_upload')) {
            // dd($pro);
            $file = $request->file_upload;
            $nameImg = $file->hashName();
            $path = Storage::put('public/product', $file, 'public');
            $pro->name = $request['name'];
            $pro->price = $request['price'];
            $pro->description = $request['description'];
            $pro->image = $nameImg;
            $pro->category_id = $request['category_id'];
            $pro->update();
        }
        //update tag
        $tagName = ($request['tag_name']);
        $tagNew = explode(',', $tagName);
        foreach ($tagNew as $tag_name) {
            $tagUpdate = new Tag();
            $tagUpdate->name = $tag_name;
            $tagUpdate->save();

            $product_tag = new Product_Tag();
            $product_tag->product_id = $pro->id;
            $product_tag->tag_id = $tagUpdate->id;
            $product_tag->save();
        }

        //upload thu vien anh
        if ($request->has('newImageGallery')) {
            foreach ($request['newImageGallery'] as $newfile) {
                $newImage = new Image();
                $newName = $newfile->hashName();
                $path = Storage::put('public/product', $newfile, 'public');
                $newImage->name = $newName;
                $newImage->is_main_image = 0;
                $newImage->product_id = $pro->id;
                $newImage->save();
            }
        }
        return response()->json(['adad' => 'sdad']);
        // $pro->update($request->all());

        // return redirect()->route('list_product');
    }

    public function getImages($id)
    {
        $product = Product::with('images')->where('products.id', $id)->first();

        return view('admin.products.list_image', compact('product'));
    }

    public function deleteImageGallery($id)
    {
        $image = Image::find($id);
        $image->delete();
        return redirect()->route('edit-product', [$image->product_id]);
    }

    public function deleteTag($id)
    {
        // $tag = Tag::find($id);
        $tag = Tag::with('products')->where('tags.id', $id)->first();
        foreach ($tag->products as $pro) {
            $proId = $pro->id;
        }
        // dd($tag);
        $tag->delete();
        return redirect()->route('edit-product', $proId);
    }
}
