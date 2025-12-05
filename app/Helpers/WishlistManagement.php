<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class WishlistManagement {

    // Add item to wishlist
    static public function addItemToWishlist($product_id){
        $wishlist_items = self::getWishlistItemsFromCookie();
        // prevent duplicates
        foreach($wishlist_items as $item){
            if($item['product_id'] == $product_id){
                return count($wishlist_items);
            }
        }

        $product = Product::find($product_id, ['id','name','price','images']);
        if($product){
            $wishlist_items[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $product->images[0],
            ];
        }

        self::addWishlistItemsToCookie($wishlist_items);

        return count($wishlist_items);
    }

    // Remove item from wishlist
    static public function removeWishlistItem($product_id){
        $wishlist_items = self::getWishlistItemsFromCookie();

        foreach($wishlist_items as $key => $item){
            if($item['product_id'] == $product_id){
                unset($wishlist_items[$key]);
            }
        }

        self::addWishlistItemsToCookie($wishlist_items);

        return $wishlist_items;
    }

    // Add wishlist items to cookie
    static public function addWishlistItemsToCookie($wishlist_items){
        Cookie::queue('wishlist_items', json_encode(array_values($wishlist_items)), 60*24*30);
    }

    // Get all wishlist items from cookie
    static public function getWishlistItemsFromCookie(){
        $items = json_decode(Cookie::get('wishlist_items'), true);
        if (!$items) $items = [];
        return $items;
    }

    // Count wishlist items
    static public function count(){
        return count(self::getWishlistItemsFromCookie());
    }

    // Clear wishlist
    static public function clearWishlistItems(){
        Cookie::queue(Cookie::forget('wishlist_items'));
    }
}
