<?php


namespace App\Repository;


interface ProductImageRepository extends BaseRepository
{
    public function imagesByProduct($productId);

    public function delete($id);
}
