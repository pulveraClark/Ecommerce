<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Products Page')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 300000;

    #[Url]
    public $sort = 'latest';

    
    public function addToCart($product_id)
{
    $total_count = CartManagement::addItemToCart($product_id);

    // Update cart count
    $this->dispatch('update-cart-count', ['total_count' => $total_count]);

     LivewireAlert::title('Successfully added to cart')
    ->text('You can continue shopping or view your cart.')
    ->position('bottom-end')   
    ->timer(3000)
    ->toast()                  
    ->show();
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

    // Search by name or brand
    if (!empty($this->search)) {
        $productQuery->where(function($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('brand', function($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        });
    }

    // Apply filters
    if (!empty($this->selected_categories)) {
        $productQuery->whereIn('category_id', $this->selected_categories);
    }

    if (!empty($this->selected_brands)) {
        $productQuery->whereIn('brand_id', $this->selected_brands);
    }

    if ($this->featured) {
        $productQuery->where('is_featured', 1);
    }

    if ($this->on_sale) {
        $productQuery->where('on_sale', 1);
    }

    if ($this->price_range) {
        $productQuery->whereBetween('price', [0, $this->price_range]);
    }

    if ($this->sort == 'latest') {
        $productQuery->latest();
    }

    if ($this->sort == 'price') {
        $productQuery->orderBy('price');
    }

    $products = $productQuery->paginate(9);

    // Flag for no search results
    $no_search_results = false;
    $alternative_products = collect();

    if (!empty($this->search) && $products->isEmpty()) {
        $no_search_results = true;
        $alternative_products = Product::where('is_active', 1)
            ->take(9) // or any number you prefer
            ->get();
    }

    return view('livewire.products-page', [
        'products' => $products,
        'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
        'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        'no_search_results' => $no_search_results,
        'alternative_products' => $alternative_products,
    ]);
    }
}
