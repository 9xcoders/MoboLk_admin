<?php


namespace App\Repository;


use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param array $attributes
     * @return bool
     */
    public function insert(array $attributes): bool;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param Model $model
     * @return bool
     */
    public function save($model): bool;
}
