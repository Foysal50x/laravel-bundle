<?php

namespace Faisal50x\LaravelBundle\Commands;

use Illuminate\Console\GeneratorCommand;
use RectorPrefix202401\Illuminate\Contracts\Console\PromptsForMissingInput;

class RepositoryContractMakeCommand extends GeneratorCommand implements PromptsForMissingInput
{
    public $signature = 'make:repo-contract {name}';

    public $description = 'Create a new Repository Contract';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/contract.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return __DIR__.$stub;
    }
}
