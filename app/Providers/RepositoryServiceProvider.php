<?php

namespace App\Providers;

use App\Repository\BannerImageRepository;
use App\Repository\BaseRepository;
use App\Repository\BaseRepositoryImpl;
use App\Repository\BrandCategoryRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\FeatureCategoryRepository;
use App\Repository\FeatureRepository;
use App\Repository\HotDealRepository;
use App\Repository\Impl\BannerImageRepositoryImpl;
use App\Repository\Impl\BrandCategoryRepositoryImpl;
use App\Repository\Impl\BrandRepositoryImpl;
use App\Repository\Impl\CategoryRepositoryImpl;
use App\Repository\Impl\FeatureCategoryRepositoryImpl;
use App\Repository\Impl\FeatureRepositoryImpl;
use App\Repository\Impl\HotDealRepositoryImpl;
use App\Repository\Impl\ProductFeatureRepositoryImpl;
use App\Repository\Impl\ProductImageRepositoryImpl;
use App\Repository\Impl\ProductRepositoryImpl;
use App\Repository\Impl\ProductVersionRepositoryImpl;
use App\Repository\Impl\ShopSettingsRepositoryImpl;
use App\Repository\Impl\TopSellingRepositoryImpl;
use App\Repository\ProductFeatureRepository;
use App\Repository\ProductImageRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductVersionRepository;
use App\Repository\ShopSettingsRepository;
use App\Repository\TopSellingRepository;
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
        $this->app->bind(ProductImageRepository::class, ProductImageRepositoryImpl::class);
        $this->app->bind(ShopSettingsRepository::class, ShopSettingsRepositoryImpl::class);
        $this->app->bind(TopSellingRepository::class, TopSellingRepositoryImpl::class);
        $this->app->bind(BannerImageRepository::class, BannerImageRepositoryImpl::class);
        $this->app->bind(HotDealRepository::class, HotDealRepositoryImpl::class);
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
