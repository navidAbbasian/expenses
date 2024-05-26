<?php

namespace App\Traits;

trait Pagination
{
    public function pagination($query , $request)
    {
        if ($request->only('search') && $request->only('col')) {
            $query = $query->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
        if ($request->only('sort')) {
            $query = $query->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $query = $query->orderBy('id', 'ASC');
        }

        return $query->paginate(10);
    }
}
