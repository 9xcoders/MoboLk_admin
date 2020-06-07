<?php


namespace App\Repository;


interface FeatureRepository extends BaseRepository
{

    public function featuresWithCategories();

    public function featureWithCategory($featureId);

    public function delete($id);
}
