<?php

namespace Faisal50x\LaravelBundle;

use Faisal50x\LaravelBundle\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements RepositoryContract
{
    public function __construct(protected ?Model $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        // TODO: Implement paginate() method.
    }

    public function create(array $data): ?Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): ?Model
    {
        $model = $this->model->findOrFail($id);

        if (! $model->update($data)) {
            return null;
        }

        return $model->refresh();
    }

    public function delete(int $id): bool
    {
        return $this->model->query()->findOrFail($id)->delete();
    }

    /**
     * @throws \Exception
     */
    public function __call(string $method, array $arguments)
    {
        if (is_null($this->model)) {
            throw new \Exception('Model not defined when the class initiated!');
        }

        if (! method_exists($this, $method)) {
            throw new \BadMethodCallException();
        }

        return call_user_func_array([$this, $method], $arguments);
    }
}
