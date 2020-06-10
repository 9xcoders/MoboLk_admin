<?php

namespace App\Http\Controllers;

use App\Repository\FeatureCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FeatureCategoryController extends Controller
{
    private $featureCategoryRepository;

    public function __construct(FeatureCategoryRepository $featureCategoryRepository)
    {
        $this->middleware('auth');
        $this->featureCategoryRepository = $featureCategoryRepository;
    }

    public function index()
    {
        $featureCategories = $this->featureCategoryRepository->featureCategoriesWithFeatures();

        foreach ($featureCategories as $featureCategory) {
            $featureCategory->featureNames = "";
            foreach ($featureCategory->features as $feature) {
                $featureCategory->featureNames .= $feature->name . ", ";
            }
            $featureCategory->featureNames = rtrim($featureCategory->featureNames, ", ");
        }

        $data = [
            'title' => 'Feature Categories',
            'featureCategories' => $featureCategories
        ];

        return view('feature-category.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = [
            'title' => 'Add Feature Category'
        ];

        return view('feature-category.add-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $featureSlug = Str::slug($request->name, '-');

        $params = $request->except('_token');
        $params['slug'] = $featureSlug;

        $customAttributes = [
            'name' => 'Name',
            'slug' => 'Name'
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:feature_categories,slug'
        ], [], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $feature = [
            'name' => $request->name,
            'slug' => $featureSlug,
            'is_filter' => $request->is_filter ? true : false
        ];

        $inserted = $this->featureCategoryRepository->create($feature);

        if ($inserted) {
            return redirect()->route('feature-category.index');
        }
        return null;
    }

    public function edit(Request $request, $id)
    {
        $featureCategory = $this->featureCategoryRepository->find($id);


        if (!$featureCategory) {
            dd("Not found");
        }

        $data = [
            'title' => 'Edit Feature Category',
            'featureCategory' => $featureCategory
        ];

        return view('feature-category.add-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $feature = $this->featureCategoryRepository->find($id);
        $params = $request->except('_token');
        $featureSlug = Str::slug($request->name, '-');
        if ($feature) {

            $params['slug'] = $featureSlug;

            $customAttributes = [
                'name' => 'Name',
                'slug' => 'Name',
            ];

            $validator = Validator::make($params, [
                'name' => 'required|max:255',
                'slug' => ['required', Rule::unique('feature_categories', 'slug')->ignore($id, 'id')],
            ], [], $customAttributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $feature->name = $request->name;
            $feature->slug = $featureSlug;
            $feature->is_filter = $request->is_filter ? true : false;

            $feature->save();

            return redirect()->route('feature-category.index');
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
