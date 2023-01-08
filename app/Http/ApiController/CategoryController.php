<?php

namespace App\Http\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    private $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRequest $request)
    {
        $result = $this->categoryService->createCate($request->validated());
        return $this->successResponse("Thêm dữ liệu thành công", $result->toArray());
    }

    public function fetchCate()
    {
        $result = $this->categoryService->getAllCate();
        return $this->successResponse("", $result->toArray());
    }

    public function getById($id)
    {
        $result = $this->categoryService->getById($id);
        return $this->successResponse("", $result->toArray());
    }

    public function deleteOneCate($id)
    {
        $this->categoryService->deleteOneCate($id);
        return $this->successResponse("Xóa dữ liệu thành công");
    }

    public function update(CategoryRequest $request, $id)
    {
        $this->categoryService->updateOneCate($request->validated(), $id);
        return $this->successResponse("Cập nhật dữ liệu thành công");
    }

    public function getAll()
    {
        return $this->categoryService->paginated();
    }
}