<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Services\ProductCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Exception;

class ProductCategoryController extends Controller
{
    private ProductCategoryService $productCategoryService;

    public function __construct(ProductCategoryService $productCategory)
    {
//        parent::__construct();
        $this->productCategoryService = $productCategory;
    }
    public function index(PaginateRequest $request): Response|AnonymousResourceCollection|Application|ResponseFactory
    {
        try {
            return ProductCategoryResource::collection($this->productCategoryService->list($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

}
