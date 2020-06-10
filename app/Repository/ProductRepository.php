<?php


namespace App\Repository;


interface ProductRepository extends BaseRepository
{
    public function productsWithCategoriesOffset($offset);

    public function productsWithCategories();

    public function productsWithCategoriesAndFiltersOffset($offset, $filters);

    public function totalProductsCount();

    public function productWithEverythingBySlug($slug);

    public function productWithEverythingById($productId);

    public function relatedProductsByProduct($product);

    public function productsByBrandCategory($category, $categoryId);

    public function delete($productId);

    public function searchProduct($searchKey);
}
