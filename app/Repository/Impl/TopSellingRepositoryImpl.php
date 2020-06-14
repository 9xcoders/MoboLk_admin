<?php


namespace App\Repository\Impl;


use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\Product;
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
        $topSelling = TopSelling::with('category')->get();

        foreach ($topSelling as $item) {
            $product = null;
            if ($item->is_version) {
                $version = $item->version;
                $product = new Product([
                    "id" => $version->product->id,
                    "unique_id" => $version->unique_id,
                    "name" => $version->product->name,
                    "slug" => $version->slug,
                    "short_desc" => $version->product->short_desc,
                    "long_desc" => $version->product->long_desc,
                    "price" => $version->price,
                    "off_price" => $version->off_price,
                    "in_stock" => $version->in_stock,
                    "category_id" => $version->product->category_id,
                    "brand_id" => $version->product->brand_id,
                    "keywords" => $version->product->keywords
                ]);

                $featureNames = '';
                foreach ($version->productFeatures as $feature) {
                    if ($feature->feature->featureCategory->is_filter) {
                        $featureNames .= $feature->feature->name . ' | ';
                    }
                }
                $featureNames = rtrim($featureNames, ' | ');
                $product->featureNames = $featureNames;
                $product->productImages = $version->productImages;
                $product->image_url = $version->productImages ? $version->productImages->first() ? $version->productImages->first()->image_url : '' : '';

            } else {
                $product = $item->product;
            }

            $item->product = $product;
            $item->product->image_url = $item->product->productImages ? $item->product->productImages->first() ? $item->product->productImages->first()->image_url : '' : '';
        }
        return $topSelling;
    }

    public function delete($id)
    {
        return TopSelling::destroy($id);
    }
}
