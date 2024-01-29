<?php

namespace Faisal50x\LaravelBundle\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\multiselect;

class RepositoryMakeCommand extends GeneratorCommand implements PromptsForMissingInput
{
    public $signature = 'make:repository {name} {--C|contract}';

    public $description = 'Create a new Repository Class';

    public function handle(): int
    {
        $this->comment('All done');

        if($this->option('contract')) {
            $this->createContract();
        }

        return self::SUCCESS;
    }

    protected function createContract(): void
    {
        $contract = Str::studly(class_basename($this->argument('name')));
        $this->info('Creating: contract for repository '. $contract);
    }

    public function buildClass($name): array|string
    {
        $interface = parent::buildClass($name);

        return str_replace(['DummyInterface', '{{ class }}'], class_basename($name), $interface);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Repositories';
    }
    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/repository.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath(string $stub): string
    {
        return __DIR__.$stub;
    }


    protected function getOptions(): array
    {
        return [
            ['contract', 'c', InputOption::VALUE_NONE, 'Create a new Contract for the repository']
        ];
    }

    public function afterPromptingForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        if ($this->isReservedName($this->getNameInput()) || $this->didReceiveOptions($input)) {
            return;
        }

        collect(multiselect('Would you like any of the following?', [
            'contract' => 'Repository Contract',
        ]))->each(fn ($option) => $input->setOption($option, true));

    }
}
