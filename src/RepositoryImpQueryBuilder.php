<?php

namespace Faisal50x\LaravelBundle;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

abstract class RepositoryImpQueryBuilder extends BaseRepository
{
    protected array $defaultSorts = ['id'];

    protected array $allowedSorts = ['id'];

    protected array $allowedFilters = [];

    protected array $allowedIncludes = [];

    protected array $defaultIncludes = [];

    /**
     * Find a record in the model by the specified id
     *
     * @param  int  $id  The id of the record to find
     * @return Model The found record
     */
    public function find(int $id): Model
    {
        return $this->newQueryBuilder()->findOrFail($id);
    }

    /**
     * Retrieve all records from the database.
     */
    public function all(): Collection
    {
        return $this->newQueryBuilder()->get();
    }

    /**
     * Paginate the records from the database.
     *
     * @param  int  $perPage  The number of records to display per page.
     * @return LengthAwarePaginator The paginated records.
     */
    public function paginate(int $perPage = 25): LengthAwarePaginator
    {
        return $this->newQueryBuilder()->paginate($perPage)->withQueryString();
    }

    /**
     * Create a new instance of the QueryBuilder.
     *
     * @param  array{allowedFilters?: array, allowedIncludes?: array, allowedSorts?: array}  $options  The options to configure the QueryBuilder [optional]
     *                                                                                                 - allowedFilters (array): The allowed filters to apply on the query [optional]
     *                                                                                                 - allowedIncludes (array): The allowed includes to load with the query [optional]
     *                                                                                                 - allowedSorts (array): The allowed sorts to apply on the query [optional]
     * @return QueryBuilder The new instance of the QueryBuilder
     */
    public function newQueryBuilder(array $options = []): QueryBuilder
    {
        $allowedFilters = $this->getOptionOrDefault($options, 'allowedFilters', $this->allowedFilters);
        $allowedIncludes = $this->getOptionOrDefault($options, 'allowedIncludes', $this->allowedIncludes);
        $allowedSorts = $this->getOptionOrDefault($options, 'allowedSorts', $this->allowedSorts);

        return QueryBuilder::for($this->model::class, $this->newRequest())
            ->defaultSorts($this->defaultSorts)
            ->allowedSorts($allowedSorts)
            ->allowedFilters($allowedFilters)
            ->allowedIncludes($allowedIncludes)
            ->when(count($this->defaultIncludes) > 0, fn ($query) => $query->with($this->defaultIncludes));
    }

    /**
     * Get the requested option value from the input array or return the default value if it does not exist or is empty.
     */
    private function getOptionOrDefault(array $options, string $optionKey, array $default): array
    {
        return isset($options[$optionKey]) && count($options[$optionKey]) > 0 ? $options[$optionKey] : $default;
    }

    /**
     * Return a new instance of Request object.
     *
     * @return Request A new instance of Request object.
     */
    protected function newRequest(): Request
    {
        /** @var Request $request */
        $request = clone \request();

        $include = $request->get('include', '');

        $includes = array_filter(explode(',', $include), fn ($relation) => in_array($relation, $this->allowedIncludes));

        $include = trim(implode(',', $includes));

        if (! $include) {
            $request->query->remove('include');

            return $request;
        }

        $request->query->set('include', $include);

        return $request;
    }
}
