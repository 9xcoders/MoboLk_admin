<?php


namespace App\Repository\Impl;


use App\Models\Category;
use App\Models\Product;
use App\Repository\BaseRepositoryImpl;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductRepositoryImpl extends BaseRepositoryImpl implements ProductRepository
{
    /**
     * CategoryRepositoryImpl constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function productsWithCategories()
    {
        return Product::with('category', 'productImages')->orderBy('created_at', 'desc')->get();
    }

    public function productsWithCategoriesOffset($offset)
    {
        return Product::with('category', 'productImages')->orderBy('created_at', 'desc')->paginate($offset);
    }

    public function productsWithCategoriesAndFiltersOffset($offset, $filters)
    {
        $products = Product::with('category', 'brand', 'productImages');

        if (array_key_exists("category", $filters)) {
            $category = $filters["category"];
            $products = $products->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        if (array_key_exists("brand", $filters)) {
            $brand = $filters["brand"];
            $products = $products->whereHas('brand', function ($query) use ($brand) {
                $query->whereIn('slug', $brand);
            });
        }

        if (array_key_exists("price", $filters)) {
            $minPrice = $filters["price"]['min'];
            $maxPrice = $filters["price"]['max'];
            $products = $products->whereBetween('price', [$minPrice, $maxPrice]);
        }
        $products = $products->inRandomOrder()->paginate($offset);
        return $products;
    }

    public function totalProductsCount()
    {
        return $this->model->all()->count();
    }

    public function productWithEverythingBySlug($slug)
    {
        return Product::with('category', 'brand', 'productImages')
            ->where('slug', $slug)->first();
    }

    public function relatedProductsByProduct($product)
    {
        return Product::with('productCategory.category', 'productImages')
            ->where('id', '!=', $product->id)
            ->whereHas('category', function ($query) use ($product) {
                $query->where('id', $product->category_id);
            })->inRandomOrder()->take(4)->get();
    }


    public function productsByBrandCategory($brandId, $categoryId)
    {
        return Product::where('brand_id', $brandId)->where('category_id', $categoryId)->inRandomOrder()->take(12)->get();
    }

    public function productWithEverythingById($productId)
    {
        return Product::with('category', 'brand', 'productVersions', 'productImages')
            ->where('id', $productId)->first();
    }

    public function delete($productId)
    {
        return Product::destroy($productId);
    }
}
