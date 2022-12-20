<?php

namespace AmooAti\CustomizableOptions\Cart;
use AmooAti\CustomizableOptions\Repositories\CartItemOptionRepository;
use Exception;
use Illuminate\Support\Facades\Event;
use Webkul\Checkout\Cart as WebkulCart;

class Cart extends WebkulCart
{
    public function addProduct($productId, $data)
    {
        Event::dispatch('checkout.cart.add.before', $productId);

        $cart = $this->getCart();

        if (! $cart) {
            $cart = $this->create($data);
        }

        if (! $cart) {
            return ['warning' => __('shop::app.checkout.cart.item.error-add')];
        }

        $product = $this->productRepository->find($productId);

        if (! $product->status) {
            return ['info' => __('shop::app.checkout.cart.item.inactive-add')];
        }

        $cartProducts = $product->getTypeInstance()->prepareForCart($data);

        $cartItemExists = false;

        if (is_string($cartProducts)) {
            if ($cart->all_items->count() <= 0) {
                $this->removeCart($cart);
            } else {
                $this->collectTotals();
            }

            throw new Exception($cartProducts);
        } else {
            $parentCartItem = null;

            foreach ($cartProducts as $cartProduct) {
                $cartItem = $this->getItemByProduct($cartProduct, $data);

                if (isset($cartProduct['parent_id'])) {
                    $cartProduct['parent_id'] = $parentCartItem->id;
                }

                if (! $cartItem) {
                    $cartItem = $this->cartItemRepository->create(array_merge($cartProduct, ['cart_id' => $cart->id]));
                } else {
                    if (
                        isset($cartProduct['parent_id'])
                        && $cartItem->parent_id !== $parentCartItem->id
                    ) {
                        $cartItem = $this->cartItemRepository->create(array_merge($cartProduct, [
                            'cart_id' => $cart->id,
                        ]));
                    } else {
                        $cartItemExists = true;
                        $cartItem = $this->cartItemRepository->update($cartProduct, $cartItem->id);
                    }
                }

                if (! $parentCartItem) {
                    $parentCartItem = $cartItem;
                }
            }
        }

        // add customizable options
        if (!$cartItemExists && isset($data['customizable_options']) && !empty($data['customizable_options'])) {
            $cartItemOptionRepository = app()->make(CartItemOptionRepository::class);
            foreach ($data['customizable_options'] as $customizableOptionId => $customizableOptionValue) {
                $cartItemOptionRepository->create([
                    'cart_item_id' => $parentCartItem->id,
                    'product_id' => $product->id,
                    'option_id' => $customizableOptionId,
                    'option_value' => $customizableOptionValue,
                ]);
            }
        }

        $price = $parentCartItem->price;

        // adding customizable options price
        foreach ($parentCartItem->options as $option) {
            $price += $option->product_option->price;
        }

        $parentCartItem->custom_price = $price;
        $parentCartItem->save();

        Event::dispatch('checkout.cart.add.after', $cart);

        $this->collectTotals();

        return $this->getCart();
    }
}