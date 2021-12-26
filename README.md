# Bagisto Product Customizable Options
Package for adding customizable options to products

## Installation

1. `composer require amooati/bagisto-customizable-options`
2. put `\AmooAti\CustomizableOption\Providers\ModuleServiceProvider::class` at the end of `config/app.php`

```
<?php
return [
   'convention' => Webkul\Core\CoreConvention::class,
        'modules' => [
             ...
             \AmooAti\CustomizableOption\Providers\ModuleServiceProvider::class
    ]
];
```
3. run `php artisan migrate`