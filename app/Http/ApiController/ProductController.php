<?php

namespace App\Http\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Product_Tag;
use App\Models\Tag;
use App\Services\Product\ProductService;
use App\Trait\ApiResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    use ApiResponse;

    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(ProductRequest $request)
    {
        // dd($this->add_image($request));


        if ($request->has('file_upload')) {
            $product = new Product();
            $file = $request->file('file_upload');
            $name = $file->hashName();
            $path = Storage::put('public/product', $file, 'public');
            $product->name = $request['name'];
            $product->imgae = $name;
            $product->price = $request['price'];
            $product->description = $request['description'];
            $product->category_id = $request['category_id'];
            $product->save();
        }

        // dd($this->add_image($request));
        // $data = $request->validated();
        // $product->create($data);
        //thêm tag cho sản phẩm
        $tag_string = $request['tag_name'];
        $tag_array = explode(',', $tag_string);
        foreach ($tag_array as $tags) {
            $tag = new Tag();
            $tag->name = $tags;
            $tag->save();

            $product_tag = new Product_Tag();
            $product_tag->product_id = $product->id;
            $product_tag->tag_id = $tag->id;
            $product_tag->save();
        }

        //thêm vào bảng trung gian

        //thêm thư viện ảnh
        if ($request->has('image_gallery')) {
            foreach ($request->file('image_gallery') as $filebb) {
                $image_gallery = new Image();

                $name_gallery = $filebb->hashName();
                $path1 = Storage::put('public/product', $filebb, 'public');
                $image_gallery->name = $name_gallery;
                $image_gallery->is_main_image = 0;
                $image_gallery->product_id = $product->id;
                $image_gallery->save();
            }
        }
        // return redirect()->route('list_product');
        return response()->json(['success' => "Add product done!"]);
    }

    public function add_image(HttpRequest $request)
    {
        if ($request->has('image')) {
            $file = $request['image'];
            $nameImg = $file->hashName();
            $path = Storage::put('public/product', $file, 'public');
        }
        return $nameImg;
    }
}
