<?php

namespace AmooAti\CustomizableOptions\Models;
use AmooAti\CustomizableOptions\Contracts\CartItemOption as CartItemOptionContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Checkout\Models\CartItemProxy;

class CartItemOption extends Model implements CartItemOptionContract
{
    protected $table = 'amooati_cart_item_options';

    protected $fillable = [
        'cart_item_id',
        'option_id',
        'option_value'
    ];

    public function cart_item(): BelongsTo
    {
        return $this->belongsTo(CartItemProxy::modelClass());
    }

    public function product_option(): BelongsTo
    {
        return $this->belongsTo(ProductOptionProxy::modelClass(), 'option_id');
    }
}