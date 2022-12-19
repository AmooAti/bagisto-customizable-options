<?php

namespace AmooAti\CustomizableOption\Providers;

use AmooAti\CustomizableOption\Repositories\ProductOptionRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Webkul\Theme\ViewRenderEventManager;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen('bagisto.admin.catalog.product.edit_form_accordian.Shipping.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('amooati-co::admin.catalog.products.customization_options');
        });

        Event::listen('catalog.product.update.after', function ($product) {
            $productOptionRepository = $this->app->make(ProductOptionRepository::class);
            $customizableOptions = request()->input('co');
            if (empty($customizableOptions)) {
                $productOptionRepository->where('product_id', $product->id)->delete();
                return;
            }
            $newProductOptionsIds = [];
            foreach ($customizableOptions as $customizableOption) {
                if (!isset($customizableOption['required'])) {
                    $customizableOption['required'] = 0;
                }
                if (empty($customizableOption['option_id'])) {
                    // create new one
                    $customizableOption['product_id'] = $product->id;
                    $newProductOption = $productOptionRepository->create($customizableOption);
                    $newProductOptionsIds[] = $newProductOption->id;
                } else {
                    // update existing one
                    $optionId = $customizableOption['option_id'];
                    unset($customizableOption['option_id']);
                    $newProductOptionsIds[] = $productOptionRepository->update($customizableOption, $optionId)->id;
                }
            }
            $product->customizable_options()->whereNotIn('id', $newProductOptionsIds)->delete();
        });
    }
}