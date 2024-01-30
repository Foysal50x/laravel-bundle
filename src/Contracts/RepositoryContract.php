<?php

declare(strict_types=1);

namespace Faisal50x\LaravelBundle\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryContract
{
    public function all(): Collection;

    public function find(int $id): Model;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): ?Model;

    public function update(array $data, int $id): ?Model;

    public function delete(int $id): bool;

    public function __call(string $method, array $arguments);
}
