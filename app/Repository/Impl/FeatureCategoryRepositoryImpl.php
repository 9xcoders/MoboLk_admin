<?php


namespace App\Repository\Impl;


use App\Models\Category;
use App\Models\FeatureCategory;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandRepository;
use App\Repository\FeatureCategoryRepository;

class FeatureCategoryRepositoryImpl extends BaseRepositoryImpl implements FeatureCategoryRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param FeatureCategory $model
     */
    public function __construct(FeatureCategory $model)
    {
        parent::__construct($model);
    }

    public function featureCategoriesWithFeatures()
    {
        return FeatureCategory::with('features')->get();
    }
}
