<?php


namespace App\Repository\Impl;


use App\Models\ProductVersion;
use App\Repository\BaseRepositoryImpl;
use App\Repository\ProductVersionRepository;

class ProductVersionRepositoryImpl extends BaseRepositoryImpl implements ProductVersionRepository
{

    /**
     * ProductVersionRepositoryImpl constructor.
     *
     * @param ProductVersion $model
     */
    public function __construct(ProductVersion $model)
    {
        parent::__construct($model);
    }
}
