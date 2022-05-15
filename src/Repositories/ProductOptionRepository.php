<?php

namespace AmooAti\CustomizableOption\Repositories;

use AmooAti\CustomizableOption\Contracts\ProductOption;
use Webkul\Core\Eloquent\Repository;

class ProductOptionRepository extends Repository
{
    public function model()
    {
        return ProductOption::class;
    }
}