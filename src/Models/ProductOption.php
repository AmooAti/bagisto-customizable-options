<?php

namespace AmooAti\CustomizableOption\Models;

use AmooAti\CustomizableOption\Contracts\ProductOption as ProductOptionContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Product\Models\ProductProxy;

class ProductOption extends TranslatableModel implements ProductOptionContract
{
    protected $table = 'amooati_product_options';

    public array $translatedAttributes = [
        'title'
    ];

    protected $with = ['translations'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductProxy::class);
    }
}