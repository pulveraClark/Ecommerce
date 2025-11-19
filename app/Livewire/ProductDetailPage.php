<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use App\Models\Product;


#[Title('Product Detail Page')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }   

    public function increaseQty(){
        $this->quantity++;
    }

    public function decreaseQty(){
        if ($this->quantity > 1){
            $this->quantity--;
        }
    }
    public function addToCart()
{
    // Find product by slug
    $product = Product::where('slug', $this->slug)->firstOrFail();

    // Add to cart using product ID
    $total_count = CartManagement::addItemToCartWithQty($product->id, $this->quantity);

    // Update cart count
    $this->dispatch('update-cart-count', ['total_count' => $total_count]);

    // Show alert
    LivewireAlert::title('Successfully added to cart')
        ->text('You can continue shopping or view your cart.')
        ->position('bottom-end')   
        ->timer(3000)
        ->toast()                  
        ->show();
}

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
