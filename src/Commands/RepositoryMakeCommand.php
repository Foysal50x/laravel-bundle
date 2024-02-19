<?php

namespace Faisal50x\LaravelBundle\Commands;

use Faisal50x\LaravelBundle\Commands\Concerns\HasModule;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class RepositoryMakeCommand extends GeneratorCommand implements PromptsForMissingInput
{
    use HasModule;

    public $signature = 'make:repository {name} {--M|model} {--T|template=basic} {--module=}';

    public $description = 'Create a new Repository Class';

    public function handle(): ?bool
    {

        if (parent::handle() === false) {
            return self::FAILURE;
        }

        $this->createContract();

        return self::SUCCESS;
    }

    protected function getNameInput(): string
    {
        $name = trim($this->argument('name'));
        if (! Str::endsWith($name, 'Repository')) {
            $name .= 'Repository';
        }

        return $name;
    }

    protected function buildClass($name): string
    {
        return str_replace('{{ Repository }}', $this->getRepositoryTemplate(), parent::buildClass($name));
    }

    protected function getRepositoryTemplate(): string
    {
        return ucfirst(trim($this->option('template'))).'Repository';
    }

    protected function createContract(): void
    {
        $contract = Str::studly(class_basename($this->argument('name')));
        $this->info('Creating: contract for repository '.$contract);

        $this->call('make:repo-contract', [
            'name' => $this->argument('name'),
            '--module' => $this->option('module'),
        ]);
    }

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/repository.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        return __DIR__.$stub;
    }

    public function afterPromptingForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        if ($this->isReservedName($this->getNameInput()) || $this->didReceiveOptions($input)) {
            return;
        }

        $selectedRepository = select(
            label: 'What Base repository you want to inherit?',
            options: [
                'basic' => 'Basic Repository',
                'advance' => 'Repository With Query Builder Implementation',
            ],
            default: 'basic'
        );

        $input->setOption('template', $selectedRepository);

        $selectModuleOption = select(
            label: 'Do you want to create repo for module?',
            options: [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            default: 'no'
        );

        if ($selectModuleOption === 'yes') {
            $module = text(
                label: 'Which module do you want to choose?',
                placeholder: 'E.g. Tenant/Auth',
                default: ''
            );
            $input->setOption('module', $module);
        }

    }
}
