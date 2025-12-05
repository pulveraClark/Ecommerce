<?php

namespace App\Livewire;

use App\Helpers\WishlistManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Wishlist')]
class WishlistPage extends Component
{
    public $wishlist_items = [];

    public function mount(){
        $this->wishlist_items = WishlistManagement::getWishlistItemsFromCookie();
    }

    public function removeItem($product_id){
        $this->wishlist_items = WishlistManagement::removeWishlistItem($product_id);

        // Update navbar count
        $this->dispatch('update-wishlist-count', [
            'wishlist_count' => count($this->wishlist_items)
        ])->to(Navbar::class);
    }

    public function render()
    {
        return view('livewire.wishlist-page');
    }
}
