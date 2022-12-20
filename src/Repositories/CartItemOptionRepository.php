<?php

namespace AmooAti\CustomizableOptions\Repositories;
use AmooAti\CustomizableOptions\Contracts\CartItemOption;
use Webkul\Core\Eloquent\Repository;

class CartItemOptionRepository extends Repository
{
    public function model(): string
    {
        return CartItemOption::class;
    }
}