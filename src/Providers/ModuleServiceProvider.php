<?php

namespace AmooAti\CustomizableOption\Providers;

use AmooAti\CustomizableOption\Models\ProductOption;
use AmooAti\CustomizableOption\Models\ProductOptionTranslations;
use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        ProductOption::class,
        ProductOptionTranslations::class
    ];
}