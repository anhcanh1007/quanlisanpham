<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class CategoryService extends CategoryRepository
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCate()
    {
        return $this->categoryRepository->all();
    }

    public function createCate(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function getById($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function deleteOneCate($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function updateOneCate($data, $id)
    {
        return $this->categoryRepository->update($data, $id);
    }

    public function paginated()
    {
        return $this->categoryRepository->paginate(3);
    }
}