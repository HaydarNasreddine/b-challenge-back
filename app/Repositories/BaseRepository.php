<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    private function appendWhere($query, $key, $value)
    {
        if (isset($value['operator']) && isset($value['value']))
            $query = $query->where($key, $value['operator'], $value['value']);
        else
            $query = $query->where($key, 'like',  '%' . $value . '%');

        return $query;
    }

    public function filter($filter, $options = null)
    {
        $query = $this->model::query();

        foreach ($filter as $key => $value) {
            if ($key != 'page' && $key != 'per_page') {
                if (is_array($value) && isset($value[0]))
                    foreach ($value as $val) {
                        $this->appendWhere($query, $key, $val);
                    }
                else
                    $this->appendWhere($query, $key, $value);
            }
        }

        if (isset($filter['per_page'])) {
            $query = $query->paginate($filter['per_page']);
        } else {
            $query = $query->get();
        }

        if(isset($options['count']))
            $query = $query->count();

        return $query;
    }
}
