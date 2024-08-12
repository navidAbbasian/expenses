<?php

namespace App\Repositories;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

abstract class Repository implements RepositoryInterface
{
    /**
     * The name of the class on which the query is applied
     */
    private string $modelClass;

    protected int $paginationLimit;

    /**
     * The object of the class on which the query is applied
     */
    protected Model $model;

    /**
     * this guard for using authenticate the user we are querying for
     */
    protected Guard $auth;

    /**
     * @throws Throwable
     */
    public function __construct(?string $modelClass = null)
    {
        $this->modelClass = $modelClass ?: self::guessModelClass();
        $this->model = app($this->modelClass);

        // This instantiation may fail during a console command if e.g. APP_KEY is empty,
        // rendering the whole installation failing.
        // TODO: fix Guard or remove it
        //        attempt(fn () => $this->auth = app(Guard::class), false);
    }

    /**
     * find class name from repository class
     */
    private static function guessModelClass(): string
    {
        return preg_replace('/(.+)\\\\Repositories\\\\(.+)Repository$/m', '$1\Models\\\$2', static::class);
    }

    /**
     * return model class name
     */
    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    /**
     * get one record by id with eloquent
     */
    public function getOneById($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * get records by ids with eloquent
     */
    public function getByIds(array $ids): Collection
    {
        return $this->model->find($ids);
    }

    /**
     * get all records with eloquent
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getOneByModelBinding($model): ?Model
    {
        return $model;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function paginate(?int $limit = null, $eloquentQuery = null): LengthAwarePaginator|Collection
    {
        $this->paginationLimit = config('app.paginate_limit');

        $eloquentQuery = $eloquentQuery ?? $this->model;

        if ($limit === 0) {
            return $eloquentQuery->get();
        }

        return $eloquentQuery->paginate($limit ?? $this->paginationLimit);
    }
}
