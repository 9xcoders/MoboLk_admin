<?php

namespace App\Http\Controllers;

use App\Repository\ProductRepository;
use App\Repository\TopSellingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class TopSellingController extends Controller
{
    private $topSellingRepository;
    private $productRepository;

    public function __construct(TopSellingRepository $topSellingRepository,
                                ProductRepository $productRepository)
    {
        $this->topSellingRepository = $topSellingRepository;
        $this->productRepository = $productRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $topSellings = $this->topSellingRepository->topSellingWithEverything();

        $data = [
            'title' => 'Top Selling List',
            'topSellings' => $topSellings
        ];
        return view('top-selling.index', compact('data'));
    }

    public function store(Request $request)
    {
        $params = $request->except('_token');

        $customAttributes = [
            'product_id' => 'Product name'
        ];

        $validator = Validator::make($params, [
            'product_id' => 'required|unique:top_sellings,product_id'
        ], [
            'product_id.required' => 'Product name is required',
            'product_id.unique' => 'Product name already exists',
        ], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = $this->productRepository->productWithEverythingById($request->product_id);
        if (!$product) {
            dd("Product not found");
        }

        $topSelling = [
            'product_id' => $product->id,
            'category_id' => $product->category->id
        ];
//        dd($topSelling);

        $inserted = $this->topSellingRepository->create($topSelling);

        if ($inserted) {
            return redirect()->route('top-selling.index');
        }
        return null;
    }

    public function delete(Request $request, $id)
    {
        $topSelling = $this->topSellingRepository->find($id);
        if (!$topSelling) {
            dd("Not found");
        }
        $this->topSellingRepository->delete($topSelling->id);
        return redirect()->route('top-selling.index');

    }
}
