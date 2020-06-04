<?php
namespace EdsonAlvesan\LaravelElephant;

use Illuminate\Support\Facades\Facade as BaseFacade;

class ElephantFacade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel.elephantio';
    }
}