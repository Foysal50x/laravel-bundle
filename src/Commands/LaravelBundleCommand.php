<?php

namespace Faisal50x\LaravelBundle\Commands;

use Illuminate\Console\Command;

class LaravelBundleCommand extends Command
{
    public $signature = 'laravel-bundle';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
