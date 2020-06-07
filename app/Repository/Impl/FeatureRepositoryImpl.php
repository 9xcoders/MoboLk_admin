<?php


namespace App\Repository\Impl;


use App\Models\Feature;
use App\Repository\BaseRepositoryImpl;
use App\Repository\FeatureRepository;

class FeatureRepositoryImpl extends BaseRepositoryImpl implements FeatureRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param Feature $model
     */
    public function __construct(Feature $model)
    {
        parent::__construct($model);
    }

    public function featuresWithCategories()
    {
        return Feature::with('featureCategory')->get();
    }

    public function featureWithCategory($featureId)
    {
        return Feature::with('featureCategory')->where('id', $featureId)->first();
    }

    public function delete($id)
    {
        return Feature::destroy($id);
    }
}
