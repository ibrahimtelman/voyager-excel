<?php

namespace VoyagerExcelExport;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use TCG\Voyager\Facades\Voyager;

class VoyagerExcelServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/lang'), 'voyager_excel');

        Voyager::addAction(\VoyagerExcelExport\Actions\Export::class);
    }
}
