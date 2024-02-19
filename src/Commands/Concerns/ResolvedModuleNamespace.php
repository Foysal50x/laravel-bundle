<?php

namespace Faisal50x\LaravelBundle\Commands\Concerns;

use Illuminate\Support\Str;

trait ResolvedModuleNamespace
{
    protected function moduleRootNamespace(): string
    {
        $rootNamespace = config('bundle.modules.root_namespace');

        if (is_string($rootNamespace) && $rootNamespace !== '') {
            return trim($rootNamespace, '\\');
        }

        $baseDir = config('bundle.modules.base_dir');

        return trim(Str::studly(str_replace('/', '\\', $baseDir)), '\\');
    }

    protected function qualifyModuleNamespace(string $module): string
    {

        $module = ltrim($module, '\\/');
        $module = str_replace('/', '\\', $module);

        $rootNamespace = $this->moduleRootNamespace();

        if (Str::startsWith($module, $rootNamespace)) {
            return $module;
        }

        return $this->qualifyModuleNamespace(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$module
        );
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace;
    }
}
