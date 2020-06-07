<?php


namespace App\Repository\Impl;


use App\Models\ProductFeature;
use App\Models\ProductVersion;
use App\Repository\BaseRepositoryImpl;
use App\Repository\ProductFeatureRepository;
use App\Repository\ProductVersionRepository;

class ProductFeatureRepositoryImpl extends BaseRepositoryImpl implements ProductFeatureRepository
{

    /**
     * ProductVersionRepositoryImpl constructor.
     *
     * @param ProductFeature $model
     */
    public function __construct(ProductFeature $model)
    {
        parent::__construct($model);
    }

    public function updateOrCreate($productFeature)
    {
        return ProductFeature::updateOrCreate($productFeature);
    }
}
