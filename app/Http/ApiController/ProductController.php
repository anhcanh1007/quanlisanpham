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
use Exception;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            $name_img = $this->add_image($request);
            $product = new Product();
            $product->image = $name_img;
            $product->fill($request->all());
            $product->save();

            //thêm tag
            $tag_string = $request['tag_name'];
            $tag_array = explode(',', $tag_string);
            foreach ($tag_array as $tags) {
                $tag = new Tag();
                $tag->name = $tags;
                $tag->save();
                //thêm vào bảng trung gian
                $product_tag = new Product_Tag();
                $product_tag->product_id = $product->id;
                $product_tag->tag_id = $tag->id;
                $product_tag->save();
            }

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
            DB::commit();
            return redirect()->route('list-product');
        } catch (\Exception $e) {
            $e->getMessage();
            // dd($e->getMessage());
            DB::rollback();
        }
    }


    public function add_image($request)
    {
        if ($request->has('file_upload')) {
            $file = $request['file_upload'];
            $name_img = $file->hashName();
            $path = Storage::put('public/product', $file, 'public');
        }
        return $name_img;
    }
}
