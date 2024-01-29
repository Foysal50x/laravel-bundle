<?php

namespace Faisal50x\LaravelBundle\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Faisal50x\LaravelBundle\LaravelBundle
 */
class LaravelBundle extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Faisal50x\LaravelBundle\LaravelBundle::class;
    }
}
