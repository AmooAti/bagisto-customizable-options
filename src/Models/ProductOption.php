<?php

namespace AmooAti\CustomizableOption\Models;

use AmooAti\CustomizableOption\Contracts\ProductOption as ProductOptionContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Product\Models\ProductProxy;

class ProductOption extends Model implements ProductOptionContract
{
    protected $table = 'amooati_product_options';

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductProxy::class);
    }
}