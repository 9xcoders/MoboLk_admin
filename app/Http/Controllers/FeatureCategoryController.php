<?php

namespace App\Http\Controllers;

use App\Repository\FeatureCategoryRepository;

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

        dd($data);
    }
}
