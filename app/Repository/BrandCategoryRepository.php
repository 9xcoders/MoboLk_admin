<?php


namespace App\Repository;


interface BrandCategoryRepository extends BaseRepository
{
    public function updateOrCreate($brandCategory);

    public function delete($brandCategoryId);

    public function deleteByBrand($brandId);
}
