<?php namespace GeneaLabs\LaravelModelCaching\Console\Commands;

use Illuminate\Console\Command;
use GeneaLabs\LaravelModelCaching\CachedModel;

class Flush extends Command
{
    protected $signature = 'modelCache:flush {--model=}';
    protected $description = 'Flush cache for a given model.';

    public function handle()
    {
        $option = $this->option('model');

        if (! $option) {
            $this->error("You must specify a model to flush a model's cache:");
            $this->line("modelCache:flush --model=App\\Model");

            return 1;
        }

        $model = new $option;

        if (! $model instanceof CachedModel) {
            $this->error("'{$option}' is not an instance of CachedModel.");
            $this->line("Only CachedModel instances can be flushed.");

            return 1;
        }

        $model->flushCache();
        $this->info("✔︎ Cache for model '{$option}' has been flushed.");
    }
}
