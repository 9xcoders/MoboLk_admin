<?php


namespace App\Repository\Impl;


use App\Models\ProductImages;
use App\Models\ProductVersion;
use App\Repository\BaseRepositoryImpl;
use App\Repository\ProductImageRepository;
use App\Repository\ProductVersionRepository;

class ProductImageRepositoryImpl extends BaseRepositoryImpl implements ProductImageRepository
{

    /**
     * ProductVersionRepositoryImpl constructor.
     *
     * @param ProductImages $model
     */
    public function __construct(ProductImages $model)
    {
        parent::__construct($model);
    }

    public function imagesByProduct($imageId)
    {
        return ProductImages::where('product_id', $imageId)->get();
    }

    public function delete($id)
    {
        return ProductImages::destroy($id);
    }
}
