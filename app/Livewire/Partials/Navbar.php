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

    public function mount(){
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($payload){
    $this->total_count = $payload['total_count'];
}
    

#[On('update-wishlist-count')]
public function updateWishlistCount($payload)
{
    $this->wishlist_count = $payload['wishlist_count'];
}
    
    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
