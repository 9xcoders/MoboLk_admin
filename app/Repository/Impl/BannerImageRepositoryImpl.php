<?php


namespace App\Repository\Impl;


use App\Models\BannerImage;
use App\Models\Category;
use App\Repository\BannerImageRepository;
use App\Repository\BaseRepositoryImpl;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BannerImageRepositoryImpl extends BaseRepositoryImpl implements BannerImageRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param BannerImage $model
     */
    public function __construct(BannerImage $model)
    {
        parent::__construct($model);
    }

    public function delete($id)
    {
        return BannerImage::destroy($id);
    }
}
