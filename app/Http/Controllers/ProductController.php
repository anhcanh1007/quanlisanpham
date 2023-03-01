<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Product_Tag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ProductController extends Controller
{
    public function index()
    {
        $pro = Product::with('category', 'tags')->orderBy('products.id')->paginate(3);

        return view('admin.products.list', compact('pro'));
    }
    public function showAdd()
    {
        $cate = Category::all();
        if (auth()->user()->can('create', Product::class)) {
            return view('admin.products.create', compact('cate'));
        } else {
            return view('admin.errors.403');
        }
    }
    public function destroy($id)
    {
        $pro = Product::find($id);
        $pro->delete();
        if (auth()->user()->can('delete', $pro)) {
            return redirect()->route('list_product');
        } else {
            return view('admin.errors.403');
        }
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
        if (Auth::user()->can('update', $pro)) {
            return view('admin.products.edit', compact('pro', 'cate'));
        } else {
            return view('admin.errors.403');
        }
    }


    public function update(Request $request)
    {
        $pro = Product::with('tags', 'images', 'product_tags')->where('products.id', $request->id)->first();
        // dd($pro);
        if ($request->has('file_upload')) {
            // dd($pro);
            $file = $request->file_upload;
            $name_img = $file->hashName();
            $path = Storage::put('public/product', $file, 'public');
            $pro->name = $request['name'];
            $pro->price = $request['price'];
            $pro->description = $request['description'];
            $pro->image = $name_img;
            $pro->category_id = $request['category_id'];
            $pro->update();
        }
        //update tag
        $tag_name = ($request['tag_name']);
        $tag_new = explode(',', $tag_name);
        foreach ($tag_new as $tag_name) {
            $tag_update = new Tag();
            $tag_update->name = $tag_name;
            $tag_update->save();

            $product_tag = new Product_Tag();
            $product_tag->product_id = $pro->id;
            $product_tag->tag_id = $tag_update->id;
            $product_tag->save();
        }

        //upload thu vien anh
        if ($request->has('newImageGallery')) {
            foreach ($request['newImageGallery'] as $new_file) {
                $image_new = new Image();
                $new_name = $new_file->hashName();
                $path = Storage::put('public/product', $new_file, 'public');
                $image_new->name = $new_name;
                $image_new->is_main_image = 0;
                $image_new->product_id = $pro->id;
                $image_new->save();
            }
        }
        return response()->json(['adad' => 'sdad']);

        //update product

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
            $pro_id = $pro->id;
        }
        // dd($tag);
        $tag->delete();
        return redirect()->route('edit-product', $pro_id);
    }
}
