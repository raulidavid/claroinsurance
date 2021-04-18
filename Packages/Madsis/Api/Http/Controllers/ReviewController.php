<?php

namespace Madsis\Api\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Madsis\Product\Repositories\ProductReviewRepository;
use Madsis\Api\Http\Resources\Catalog\ProductReview as ProductReviewResource;

class ReviewController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;

    /**
     * ProductReviewRepository object
     *
     * @var \Madsis\Product\Repositories\ProductReviewRepository
     */
    protected $reviewRepository;

    /**
     * Controller instance
     *
     * @param  Madsis\Product\Repositories\ProductReviewRepository  $reviewRepository
     */
    public function __construct(ProductReviewRepository $reviewRepository)
    {
        $this->guard = request()->has('token') ? 'Api' : 'customer';

        auth()->setDefaultDriver($this->guard);

        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $customer = auth($this->guard)->user();

        $this->validate(request(), [
            'comment' => 'required',
            'rating'  => 'required|numeric|min:1|max:5',
            'title'   => 'required',
        ]);

        $data = array_merge(request()->all(), [
            'customer_id' => $customer ? $customer->id : null,
            'name'        => $customer ? $customer->name : request()->input('name'),
            'status'      => 'pending',
            'product_id'  => $id,
        ]);

        $productReview = $this->reviewRepository->create($data);

        return response()->json([
            'message' => 'Your review submitted successfully.',
            'data'    => new ProductReviewResource($this->reviewRepository->find($productReview->id)),
        ]);
    }
}