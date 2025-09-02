<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Repositories\Task\ProductSetDriverRepository;

class ProductController extends Controller
{
    protected ProductSetDriverRepository $productRepository;

    public function __construct(ProductSetDriverRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        // set Driver => File or Mysql
        $products = $this->productRepository->setDriver('File')->getAll();
        dd($products);
    }

    public function getProduct()
    {
    }

    public function createProduct()
    {
    }

    public function updateProduct()
    {
    }

    public function deleteProduct()
    {
    }
}
