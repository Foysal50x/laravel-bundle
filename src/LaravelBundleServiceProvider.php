<?php

namespace Faisal50x\LaravelBundle;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Faisal50x\LaravelBundle\Commands\LaravelBundleCommand;

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
            ->hasViews()
            ->hasMigration('create_laravel-bundle_table')
            ->hasCommand(LaravelBundleCommand::class);
    }
}
