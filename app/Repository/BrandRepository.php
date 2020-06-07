<?php


namespace App\Repository;


interface BrandRepository extends BaseRepository
{
    public function brandCategoriesShowHome();

    public function brandsWithCategories();

    public function brandWithCategories($brandId);

    public function delete($brandId);

    public function brandByCategory($categoryId);

}
