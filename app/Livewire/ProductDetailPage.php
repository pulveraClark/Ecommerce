<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Helpers\WishlistManagement;
use App\Models\Product;
use Livewire\Component;


class ProductDetailPage extends Component
{
   

    public $slug;
    public $quantity = 1;
    public $product;

    public function mount($slug)
    {
        $this->slug = $slug;

        // Load product once here
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }

    /**
     * Add the product to the cart
     */
    public function addToCart()
    {
        $total_count = CartManagement::addItemToCartWithQty($this->product->id, $this->quantity);

        // Update cart count in Navbar
        $this->dispatch('update-cart-count', ['total_count' => $total_count]);

        // Show success alert
        
    }

    /**
     * Add the product to the wishlist
     */
    public function addToWishlist()
    {
        $total_count = WishlistManagement::addItemToWishlist($this->product->id);

        // Update wishlist count in Navbar
        $this->dispatch('update-wishlist-count', ['wishlist_count' => $total_count]);

       
       
    }

    /**
     * Increase quantity
     */
    public function increaseQty()
    {
        $this->quantity++;
    }

    /**
     * Decrease quantity
     */
    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        return view('livewire.product-detail-page');
    }
}
