<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;

class ProductService extends ProductRepository
{
    public function __construct(protected ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProduct()
    {
        return $this->productRepository->all();
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }
}