<?php

namespace Faisal50x\LaravelBundle\Commands;

use Faisal50x\LaravelBundle\Commands\Concerns\ResolvedModuleNamespace;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ModuleMakeCommand extends Command implements PromptsForMissingInput
{
    use ResolvedModuleNamespace;

    public $signature = 'make:module {name} {--M|model} {--MI|migration} {--R|route} {--F|factory} {--S|seeder}';

    public $description = 'Create a new Module';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    public function handle(): int
    {

        $name = $this->getNameInput();

        $moduleDirectory = $this->makeDirectory($this->getDirectory($name));

        $namespace = $this->qualifyModuleNamespace($name);

        $this->info("Creating module: $namespace, $moduleDirectory");

        return self::SUCCESS;
    }

    protected function getNameInput(): string
    {
        return trim($this->argument('name'));
    }

    protected function getDirectory($name): string
    {
        $name = Str::lower($name);
        $name = Str::replaceFirst($this->moduleRootNamespace(), '', $name);

        return config('bundle.modules.base_dir').'/'.str_replace('\\', '/', $name);
    }

    protected function makeDirectory($path): string
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
