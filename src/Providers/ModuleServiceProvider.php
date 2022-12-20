<?php

namespace AmooAti\CustomizableOptions\Providers;

use AmooAti\CustomizableOptions\Models\CartItemOption;
use AmooAti\CustomizableOptions\Models\ProductOption;
use AmooAti\CustomizableOptions\Models\ProductOptionTranslation;
use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        ProductOption::class,
        ProductOptionTranslation::class,
        CartItemOption::class
    ];
}