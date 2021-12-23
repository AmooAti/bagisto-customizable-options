<?php

namespace AmooAti\CustomizableOption\Providers;

use AmooAti\CustomizableOption\Models\ProductOption;
use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        ProductOption::class
    ];
}