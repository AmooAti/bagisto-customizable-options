<?php

namespace AmooAti\CustomizableOptions\Models;

use AmooAti\CustomizableOptions\Contracts\ProductOption as ProductOptionContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Product\Models\ProductProxy;

class ProductOption extends TranslatableModel implements ProductOptionContract
{
    protected $table = 'amooati_product_options';

    protected $fillable = [
        'required',
        'price',
        'type',
        'position',
        'max_characters',
        'product_id',
        'file_extension',
        'max_file_size',
        'max_image_size_x',
        'max_image_size_y',
    ];

    public array $translatedAttributes = [
        'title',
    ];

    protected $with = ['translations'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductProxy::class);
    }
}