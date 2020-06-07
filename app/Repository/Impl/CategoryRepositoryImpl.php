<?php


namespace App\Repository\Impl;


use App\Models\Category;
use App\Repository\BaseRepositoryImpl;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryRepositoryImpl extends BaseRepositoryImpl implements CategoryRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function categoryWithBrands()
    {
        return Category::with('categoryBrands.brand')->get();
    }
}
