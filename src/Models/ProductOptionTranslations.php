<?php

namespace AmooAti\CustomizableOption\Models;

use AmooAti\CustomizableOption\Contracts\ProductOptionTranslation;
use Illuminate\Database\Eloquent\Model;

class ProductOptionTranslations extends Model implements ProductOptionTranslation
{
    protected $table = 'amooati_product_option_translations';

    protected $fillable = [
        'title',
        'locale'
    ];
}