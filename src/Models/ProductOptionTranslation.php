<?php

namespace AmooAti\CustomizableOption\Models;

use AmooAti\CustomizableOption\Contracts\ProductOptionTranslation as ProductOptionTranslationContract;
use Illuminate\Database\Eloquent\Model;

class ProductOptionTranslation extends Model implements ProductOptionTranslationContract
{
    protected $table = 'amooati_product_option_translations';

    protected $fillable = [
        'title',
        'locale'
    ];
}