<?php


namespace App\Repository;


interface FeatureCategoryRepository extends BaseRepository
{
    public function featureCategoriesWithFeatures();
}
