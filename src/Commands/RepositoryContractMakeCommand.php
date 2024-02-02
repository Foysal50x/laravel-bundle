<?php

namespace Faisal50x\LaravelBundle\Commands;

use Faisal50x\LaravelBundle\Commands\Concerns\HasModule;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use RectorPrefix202401\Illuminate\Contracts\Console\PromptsForMissingInput;

class RepositoryContractMakeCommand extends GeneratorCommand
{
    use HasModule;
    protected $hidden = true;
    public $signature = 'make:repo-contract {name} {--module=}';

    public $description = 'Create a new Repository Contract';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/contract.stub');
    }

    protected function getNameInput(): string
    {
        $name = trim($this->argument('name'));
        if(!Str::contains($name, "Contract")) {
            $name .="Contract";
        }
        return $name;
    }

    protected function buildClass($name): string
    {
        return str_replace('{{ interface }}', $this->getNameInput(), parent::buildClass($name));
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $namespace = '';
        if ($this->option('module')) {
            $appDir = Str::studly($this->getModuleSrcPath());
            $namespace = $this->resolvedModuleNamespace($this->option('module'))."\\${appDir}\\";
        }

        $namespace .= str_replace('/', "\\",  trim(config('bundle.repository.dir', 'Repositories'), "/"))."\\";
        $namespace .= str_replace('/', "\\", trim(config('bundle.repository.contract.dir', 'Contracts'), "/"));

        return parent::getDefaultNamespace("{$rootNamespace}\\{$namespace}");

    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return __DIR__.$stub;
    }
}
