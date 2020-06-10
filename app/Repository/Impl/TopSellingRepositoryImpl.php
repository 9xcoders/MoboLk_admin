<?php


namespace App\Repository\Impl;


use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\TopSelling;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\TopSellingRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TopSellingRepositoryImpl extends BaseRepositoryImpl implements TopSellingRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param TopSelling $model
     */
    public function __construct(TopSelling $model)
    {
        parent::__construct($model);
    }

    public function topSellingWithEverything()
    {
        return TopSelling::with('product', 'category')->get();
    }

    public function delete($id)
    {
        return TopSelling::destroy($id);
    }
}
