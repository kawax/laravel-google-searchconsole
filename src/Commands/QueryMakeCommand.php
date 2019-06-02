<?php

namespace Revolution\Google\SearchConsole\Commands;

use Illuminate\Console\GeneratorCommand;

class QueryMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:search:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Search Query class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'SearchQuery';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/query.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Search';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
