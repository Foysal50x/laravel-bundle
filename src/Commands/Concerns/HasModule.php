<?php

namespace Faisal50x\LaravelBundle\Commands\Concerns;

use Illuminate\Support\Str;

trait HasModule
{
    use ResolvedModuleNamespace;
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        $namespace = '';

        if ($this->option('module')) {
            $appDir = Str::studly($this->getModuleSrcPath());
            $namespace = $this->resolvedModuleNamespace($this->option('module'))."\\{$appDir}\\";
        }

        $namespace .= str_replace('/', '\\', trim(config('bundle.repository.dir', 'Repositories'), '/'));

        return parent::getDefaultNamespace("{$rootNamespace}\\{$namespace}");
    }

    protected function rootNamespace(): string
    {
        if ($this->option('module')) {

            return $this->moduleRootNamespace();
        }

        return parent::rootNamespace();
    }

    protected function resolvedModuleNamespace(string $module): string
    {
        return Str::studly(trim(str_replace('/', '\\', $module), '\\'));
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $dir = $this->option('module') ? base_path($this->getModuleBasePath()) : $this->laravel['path'];

        return $dir.'/'.str_replace('\\', '/', ltrim($name, '\\')).'.php';
    }

    protected function getModuleBasePath(): string
    {
        return trim(config('bundle.modules.base_dir'), '\\/');
    }

    protected function getModuleSrcPath(): string
    {
        return trim(config('bundle.modules.src_dir'), '/');
    }
}
