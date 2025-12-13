<?php

namespace App\Livewire\Partials;

use App\Helpers\WishlistManagement;
use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;
    public $wishlist_count = 0;

    public function mount()
    {
        // Initialize counts
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
        $this->wishlist_count = count(WishlistManagement::getWishlistItemsFromCookie());
    }

    // ------------------------------
    // CART COUNT LISTENER
    // ------------------------------
    #[On('update-cart-count')]
    public function updateCartCount()
    {
        // No payload sent → recalculate manually
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    // ------------------------------
    // WISHLIST COUNT LISTENER
    // ------------------------------
    #[On('update-wishlist-count')]
    public function updateWishlistCount($payload)
    {
        // Wishlist does send payload → receive it
        $this->wishlist_count = $payload['wishlist_count'] ?? 0;
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
