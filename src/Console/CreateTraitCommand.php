<?php
/**
 * Created by PhpStorm.
 * User: youxingxiang
 * Date: 2020/7/23
 * Time: 12:41 PM
 */
namespace Yxx\LaravelQuick\Console;

use Illuminate\Console\GeneratorCommand;

class CreateTraitCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quick:create-trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Trait';

    /**
     * @return string
     */
    public function getStub()
    {
        return __DIR__.'/stubs/trait.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Traits';
    }
}
