<?php


namespace App\Repository\Impl;


use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\HotDeal;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\HotDealRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class HotDealRepositoryImpl extends BaseRepositoryImpl implements HotDealRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param HotDeal $model
     */
    public function __construct(HotDeal $model)
    {
        parent::__construct($model);
    }

    public function delete($brandId)
    {
        return HotDeal::destroy($brandId);
    }
}
