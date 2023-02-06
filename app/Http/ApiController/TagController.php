<?php

namespace App\Http\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Services\Tag\TagService;
use App\Trait\ApiResponse;

class TagController extends Controller
{
    use ApiResponse;

    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function create(TagRequest $request)
    {
        $result = $this->tagService->create($request->validated());
        return $this->successResponse('Thêm tag thành công', $result->toArray());
    }

    public function index()
    {
        return $this->tagService->paginated();
    }

    public function edit($id)
    {
        $result = $this->tagService->find($id);
        return $this->successResponse("", $result->toArray());
    }

    public function update(TagRequest $request, $id)
    {
        $result = $this->tagService->update($request->validated(), $id);
        return $this->successResponse("Cập nhật dữ liệu thành công");
    }

    public function destroy($id)
    {
        $this->tagService->delete($id);
        return $this->successResponse("Xóa dữ liệu thành công");
    }
}