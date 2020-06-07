<?php


namespace App\Repository;


interface CategoryRepository extends BaseRepository
{
    public function categoryWithBrands();
}
