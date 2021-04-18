<?php

namespace Madsis\Api\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Madsis\Product\Repositories\ProductRepository;
use Madsis\Api\Http\Resources\Catalog\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var \Madsis\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Madsis\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection($this->productRepository->getAll(request()->input('category_id')));
    }

    /**
     * Returns a individual resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return new ProductResource(
            $this->productRepository->findOrFail($id)
        );
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function additionalInformation($id)
    {
        return response()->json([
            'data' => app('Madsis\Product\Helpers\View')->getAdditionalData($this->productRepository->findOrFail($id)),
        ]);
    }

    /**
     * Returns product's additional information.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return response()->json([
            'data' => app('Madsis\Product\Helpers\ConfigurableOption')->getConfigurationConfig($this->productRepository->findOrFail($id)),
        ]);
    }
}
