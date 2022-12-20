<?php

namespace AmooAti\CustomizableOptions\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webkul\Product\Models\Product as WebkulProduct;

class Product extends WebkulProduct
{
    public function customizable_options(): HasMany
    {
        return $this->hasMany(ProductOptionProxy::modelClass());
    }
}