<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class CoreRepository
{
    /**
     * @var TModel
     */
    private Model $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;

    /**
     * @return TModel
     */
    protected function startConditions(): Model
    {
        return clone $this->model;
    }
}
