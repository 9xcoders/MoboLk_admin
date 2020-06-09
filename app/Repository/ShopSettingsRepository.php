<?php


namespace App\Repository;


interface ShopSettingsRepository extends BaseRepository
{
    public function shopSettings();

    public function updateOrCreate($settings);
}
