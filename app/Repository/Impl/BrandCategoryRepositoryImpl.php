<?php


namespace App\Repository\Impl;


use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandCategoryRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BrandCategoryRepositoryImpl extends BaseRepositoryImpl implements BrandCategoryRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param BrandCategory $model
     */
    public function __construct(BrandCategory $model)
    {
        parent::__construct($model);
    }

    public function updateOrCreate($brandCategory)
    {
        return BrandCategory::updateOrCreate($brandCategory);
    }

    public function delete($brandCategoryId)
    {
        return BrandCategory::destroy($brandCategoryId);
    }

    public function deleteByBrand($brandId)
    {
        return BrandCategory::where('brand_id', $brandId)->delete();
    }
}
