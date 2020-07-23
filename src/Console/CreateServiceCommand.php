<?php
/**
 * Created by PhpStorm.
 * User: youxingxiang
 * Date: 2020/7/23
 * Time: 12:39 PM
 */
namespace Yxx\LaravelQuick\Console;

use Illuminate\Console\GeneratorCommand;

class CreateServiceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quick:create-service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Service';

    /**
     * @return string
     */
    public function getStub()
    {
        return __DIR__.'/stubs/service.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Services';
    }
}
