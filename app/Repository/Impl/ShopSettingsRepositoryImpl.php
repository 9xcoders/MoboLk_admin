<?php


namespace App\Repository\Impl;


use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\ShopSettings;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandCategoryRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\ShopSettingsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ShopSettingsRepositoryImpl extends BaseRepositoryImpl implements ShopSettingsRepository
{
    /**
     * ShopSettingsRepositoryImpl constructor.
     *
     * @param ShopSettings $model
     */
    public function __construct(ShopSettings $model)
    {
        parent::__construct($model);
    }

    public function shopSettings()
    {
        return ShopSettings::all()->first();
    }

    public function updateOrCreate($settings)
    {
        return ShopSettings::updateOrCreate($settings);
    }
}
