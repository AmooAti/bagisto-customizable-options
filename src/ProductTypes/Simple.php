<?php

namespace AmooAti\CustomizableOptions\ProductTypes;

use Webkul\Product\Type\Simple as WebkulSimple;

class Simple extends WebkulSimple
{
    public function compareOptions($options1, $options2): ?bool
    {
        if ($this->product->id != $options2['product_id']) {
            return false;
        } else {
            if (!is_null($compareCustomizableOptions = $this->compareOptionCustomizableOptions($options1, $options2))) {
                return $compareCustomizableOptions;
            }

            if (
                isset($options1['parent_id'])
                && isset($options2['parent_id'])
            ) {
                if ($options1['parent_id'] == $options2['parent_id']) {
                    return true;
                } else {
                    return false;
                }
            } elseif (
                isset($options1['parent_id'])
                && ! isset($options2['parent_id'])
            ) {
                return false;
            } elseif (
                isset($options2['parent_id'])
                && ! isset($options1['parent_id'])
            ) {
                return false;
            }
        }

        return true;
    }

    public function compareOptionCustomizableOptions($option1, $option2): ?bool
    {
        if (isset($option1['customizable_options']) && isset($option2['customizable_options'])) {
            if ((count($option1['customizable_options']) != count($option2['customizable_options'])) || count(array_udiff_assoc($option1['customizable_options'], $option2['customizable_options'], function ($a, $b) {
                    return $a === $b ? 0 : 1;
                }))) {
                return false;
            } else {
                return true;
            }
        } else if (isset($option2['customizable_options']) && !isset($option1['customizable_options'])) {
            return false;
        } elseif (isset($option1['customizable_options']) && !isset($option2['customizable_options'])) {
            return false;
        }
        return null;
    }
}