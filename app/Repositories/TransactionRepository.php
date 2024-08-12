<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionRepository extends Repository
{
    protected array $selectAbleFields = ['id', 'department_id', 'name', 'created_at', 'updated_at'];

    protected array $sortAbleFields = ['created_at', 'id'];

    protected array $filterAbleFields = ['name', 'department_id'];

    protected array $includeAbleRelations = ['department', 'tickets'];

    protected string $defaultSortField = 'created_at';

    public function getOneByModelBinding($model): ?Model
    {
        return QueryBuilder::for(Transaction::where('id', $model->id))
            ->allowedIncludes($this->includeAbleRelations)
            ->first();
    }

    public function paginate($limit = null, $eloquentQuery = null): Collection|LengthAwarePaginator
    {
        parent::paginate($limit);

        $transactions = [];
        $banks = Bank::query()->where('account_owner', auth()->user()->id)->get();
        for ($i = 0; $i < count($banks); $i++) {
            $transactions = Transaction::query()->where('to', $banks[$i]->id)->orWhere('from', $banks[$i]->id);
        }

        $query = QueryBuilder::for($transactions)
            ->allowedFields($this->selectAbleFields)
            ->defaultSort($this->defaultSortField)
            ->allowedSorts($this->sortAbleFields)
            ->allowedFilters($this->filterAbleFields)
            ->allowedIncludes($this->includeAbleRelations);
        if ($limit === 0) {
            return $query->get();
        } else {
            return $query->paginate($limit ?? $this->paginationLimit);
        }
    }
}
