<?php

namespace App\Livewire;

use App\Helpers\WishlistManagement;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Wishlist')]
class WishlistPage extends Component
{
    public $wishlist_items = [];

    public function mount()
    {
        $this->wishlist_items = WishlistManagement::getWishlistItemsFromCookie();
    }

    public function removeItem($product_id)
    {
        $this->wishlist_items = WishlistManagement::removeWishlistItem($product_id);

        $this->dispatch('update-wishlist-count', [
            'wishlist_count' => count($this->wishlist_items)
        ])->to(Navbar::class);
    }

    public function addToCart($product_id)
    {
        CartManagement::addToCart($product_id);
        
        // Remove from wishlist after adding to cart
        $this->wishlist_items = WishlistManagement::removeWishlistItem($product_id);

        // Update both navbar counters
        $this->dispatch('update-cart-count')->to(Navbar::class);
        $this->dispatch('update-wishlist-count', [
            'wishlist_count' => count($this->wishlist_items)
        ])->to(Navbar::class);
    }

    public function isInCart($product_id)
    {
        return CartManagement::itemExists($product_id);
    }

    public function render()
    {
        return view('livewire.wishlist-page');
    }
}
