<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // ----------------------------------------
    // Check if product exists in cart
    // ----------------------------------------
    public static function itemExists($product_id)
    {
        $cart = self::getCartItemsFromCookie();

        foreach ($cart as $item) {
            if ($item['product_id'] == $product_id) {
                return true;
            }
        }
        return false;
    }

    // ----------------------------------------
    // Add item to cart (default qty = 1)
    // ----------------------------------------
    public static function addToCart($product_id)
    {
        return self::addItemToCart($product_id);
    }

    public static function addItemToCart($product_id)
    {
        $cart = self::getCartItemsFromCookie();
        $found = false;

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart[$key]['quantity']++;
                $cart[$key]['total_amount'] = $cart[$key]['quantity'] * $cart[$key]['unit_amount'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $product = Product::find($product_id);

            if ($product) {
                $cart[] = [
                    'product_id'   => $product->id,
                    'name'         => $product->name,
                    'image'        => $product->images[0] ?? null,
                    'quantity'     => 1,
                    'unit_amount'  => $product->price,
                    'total_amount' => $product->price
                ];
            }
        }

        self::addCartItemsToCookie($cart);
        return count($cart);
    }

    // ----------------------------------------
    // Add with specific quantity
    // ----------------------------------------
    public static function addItemToCartWithQty($product_id, $qty = 1)
    {
        $cart = self::getCartItemsFromCookie();
        $found = false;

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart[$key]['quantity'] = $qty;
                $cart[$key]['total_amount'] = $qty * $cart[$key]['unit_amount'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $product = Product::find($product_id);

            if ($product) {
                $cart[] = [
                    'product_id'   => $product->id,
                    'name'         => $product->name,
                    'image'        => $product->images[0] ?? null,
                    'quantity'     => $qty,
                    'unit_amount'  => $product->price,
                    'total_amount' => $product->price * $qty
                ];
            }
        }

        self::addCartItemsToCookie($cart);
        return count($cart);
    }

    // ----------------------------------------
    // Remove item
    // ----------------------------------------
    public static function removeCartItem($product_id)
    {
        $cart = self::getCartItemsFromCookie();

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart[$key]);
            }
        }

        self::addCartItemsToCookie($cart);
        return $cart;
    }

    // ----------------------------------------
    // Cookie handling
    // ----------------------------------------
    public static function addCartItemsToCookie($cart)
    {
        Cookie::queue('cart_items', json_encode(array_values($cart)), 60 * 24 * 30);
    }

    public static function getCartItemsFromCookie()
    {
        return json_decode(Cookie::get('cart_items'), true) ?? [];
    }

    public static function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // ----------------------------------------
    // Increment & decrement
    // ----------------------------------------
    public static function incrementQuantityToCartItem($product_id)
    {
        $cart = self::getCartItemsFromCookie();

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart[$key]['quantity']++;
                $cart[$key]['total_amount'] = $cart[$key]['quantity'] * $cart[$key]['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart);
        return $cart;
    }

    public static function decrementQuantityToCartItem($product_id)
    {
        $cart = self::getCartItemsFromCookie();

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $product_id && $cart[$key]['quantity'] > 1) {
                $cart[$key]['quantity']--;
                $cart[$key]['total_amount'] = $cart[$key]['quantity'] * $cart[$key]['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart);
        return $cart;
    }

    // ----------------------------------------
    // Calculate total price
    // ----------------------------------------
    public static function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
