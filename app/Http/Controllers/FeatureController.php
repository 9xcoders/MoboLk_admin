<?php

namespace App\Http\Controllers;

use App\Repository\FeatureCategoryRepository;
use App\Repository\FeatureRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FeatureController extends Controller
{
    private $featureRepository;
    private $featureCategoryRepository;

    public function __construct(FeatureCategoryRepository $featureCategoryRepository,
                                FeatureRepository $featureRepository)
    {
        $this->middleware('auth');
        $this->featureRepository = $featureRepository;
        $this->featureCategoryRepository = $featureCategoryRepository;
    }

    public function index()
    {
        $features = $this->featureRepository->featuresWithCategories();

        $data = [
            'title' => 'Features',
            'features' => $features
        ];
        return view('feature.index', compact('data'));
    }

    public function create(Request $request)
    {
        $categories = $this->featureCategoryRepository->all();

        $data = [
            'title' => 'Add Feature',
            'categories' => $categories
        ];

        return view('feature.add-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $featureSlug = Str::slug($request->name, '-');

        $params = $request->except('_token');
        $params['slug'] = $featureSlug;

        $customAttributes = [
            'name' => 'Name',
            'slug' => 'Name',
            'feature_category_id' => 'Category',
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'feature_category_id' => 'required',
            'slug' => 'required|unique:features,slug'
        ], [], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $feature = [
            'name' => $request->name,
            'slug' => $featureSlug,
            'feature_category_id' => $request->feature_category_id
        ];


        $inserted = $this->featureRepository->create($feature);

        if ($inserted) {
            return redirect()->route('feature.index');
        }
        return null;
    }

    public function edit(Request $request, $id)
    {
        $categories = $this->featureCategoryRepository->all();
        $feature = $this->featureRepository->featureWithCategory($id);


        if (!$feature) {
            dd("Not found");
        }

        $data = [
            'title' => 'Edit Feature',
            'categories' => $categories,
            'feature' => $feature
        ];

        return view('feature.add-edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $feature = $this->featureRepository->find($id);
        $params = $request->except('_token');
        $featureSlug = Str::slug($request->name, '-');
        if ($feature) {

            $params['slug'] = $featureSlug;

            $customAttributes = [
                'name' => 'Name',
                'slug' => 'Name',
                'feature_category_id' => 'Category',
            ];

            $validator = Validator::make($params, [
                'name' => 'required|max:255',
                'feature_category_id' => 'required',
                'slug' => ['required', Rule::unique('features', 'slug')->ignore($id, 'id')],
            ], [], $customAttributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $feature->name = $request->name;
            $feature->slug = $featureSlug;
            $feature->feature_category_id = $request->feature_category_id;

            $feature->save();

            return redirect()->route('feature.index');
        } else {
            dd("Not found");
        }
    }

    public function delete(Request $request, $id)
    {
        $feature = $this->featureRepository->find($id);
        if (!$feature) {
            dd("Not found");
        }
        $this->featureRepository->delete($feature->id);
        return redirect()->route('feature.index');

    }
}
