<?php

namespace App\Providers;

use App\Repository\BaseRepository;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandCategoryRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\FeatureCategoryRepository;
use App\Repository\FeatureRepository;
use App\Repository\Impl\BrandCategoryRepositoryImpl;
use App\Repository\Impl\BrandRepositoryImpl;
use App\Repository\Impl\CategoryRepositoryImpl;
use App\Repository\Impl\FeatureCategoryRepositoryImpl;
use App\Repository\Impl\FeatureRepositoryImpl;
use App\Repository\Impl\ProductFeatureRepositoryImpl;
use App\Repository\Impl\ProductRepositoryImpl;
use App\Repository\Impl\ProductVersionRepositoryImpl;
use App\Repository\ProductFeatureRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductVersionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepository::class, BaseRepositoryImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->bind(BrandRepository::class, BrandRepositoryImpl::class);
        $this->app->bind(BrandCategoryRepository::class, BrandCategoryRepositoryImpl::class);
        $this->app->bind(FeatureCategoryRepository::class, FeatureCategoryRepositoryImpl::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
        $this->app->bind(ProductVersionRepository::class, ProductVersionRepositoryImpl::class);
        $this->app->bind(FeatureRepository::class, FeatureRepositoryImpl::class);
        $this->app->bind(ProductFeatureRepository::class, ProductFeatureRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
