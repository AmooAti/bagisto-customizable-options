<?php

namespace AmooAti\CustomizableOptions\Contracts;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface CartItemOption
{
    public function cart_item(): BelongsTo;

    public function product_option(): BelongsTo;
}