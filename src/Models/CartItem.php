<?php

namespace AmooAti\CustomizableOptions\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Webkul\Checkout\Models\CartItem as WebkulCartItem;

class CartItem extends WebkulCartItem
{
    public function options(): HasMany
    {
        return $this->hasMany(CartItemOptionProxy::modelClass(), 'cart_item_id');
    }
}