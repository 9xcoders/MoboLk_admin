<?php

namespace App\Http\Controllers;

use App\Repository\ProductRepository;
use App\Repository\ProductVersionRepository;
use App\Repository\TopSellingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TopSellingController extends Controller
{
    private $topSellingRepository;
    private $productRepository;
    private $versionRepository;

    public function __construct(TopSellingRepository $topSellingRepository,
                                ProductRepository $productRepository, ProductVersionRepository $versionRepository)
    {
        $this->topSellingRepository = $topSellingRepository;
        $this->productRepository = $productRepository;
        $this->versionRepository = $versionRepository;
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
            'product_id' => [
                'required',
                Rule::unique('top_sellings')->where(function ($query) use ($request) {
                    return $query->where('product_id', $request->product_id)
                        ->where('is_version', $request->is_version);
                }),
            ]
        ], [
            'product_id.required' => 'Product name is required',
            'product_id.unique' => 'Product name already exists',
        ], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

//        dd($params);
        $product = null;
        if ($request->is_version) {
            $product = $this->versionRepository->productVersionWithEverythingById($request->product_id);

        } else {
            $product = $this->productRepository->productWithEverythingById($request->product_id);
        }


        if (!$product) {
            dd("Product not found");
        }

        $topSelling = [
            'product_id' => $product->id,
            'category_id' => $request->is_version ? $product->product->category->id : $product->category->id,
            'is_version' => $request->is_version ? 1 : 0
        ];

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
