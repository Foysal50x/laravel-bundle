<?php

namespace Faisal50x\LaravelBundle\Commands\Concerns;

use Illuminate\Support\Str;

trait HasModule
{
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
            return Str::studly($this->getModulePath());
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

        $dir = $this->option('module') ? base_path($this->getModulePath()) : $this->laravel['path'];

        return $dir.'/'.str_replace('\\', '/', ltrim($name, '\\')).'.php';
    }

    protected function getModulePath(): string
    {
        return trim(config('bundle.repository.modules.base_dir'), '\\');
    }

    protected function getModuleSrcPath(): string
    {
        return config('bundle.repository.modules.src_dir');
    }
}
