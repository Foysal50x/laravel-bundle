<?php

namespace Faisal50x\LaravelBundle;

use Faisal50x\LaravelBundle\Commands\ModuleMakeCommand;
use Faisal50x\LaravelBundle\Commands\RepositoryContractMakeCommand;
use Faisal50x\LaravelBundle\Commands\RepositoryMakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBundleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-bundle')
            ->hasConfigFile()
            ->hasCommand(ModuleMakeCommand::class)
            ->hasCommand(RepositoryMakeCommand::class)
            ->hasCommand(RepositoryContractMakeCommand::class);
    }
}
