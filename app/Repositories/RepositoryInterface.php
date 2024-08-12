<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * get one record by id with eloquent
     */
    public function getOneById($id): ?Model;

    /**
     * get records by ids with eloquent
     */
    public function getByIds(array $ids): Collection;

    /**
     * get all records with eloquent
     */
    public function getAll(): Collection;

    public function getOneByModelBinding($model): ?Model;

    public function paginate(?int $limit = null): LengthAwarePaginator|Collection;
}
