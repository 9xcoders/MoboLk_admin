<?php


namespace App\Repository;


interface TopSellingRepository extends BaseRepository
{
    public function topSellingWithEverything();

    public function delete($id);

}
