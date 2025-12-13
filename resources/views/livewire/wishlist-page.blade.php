<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Wishlist</h1>

        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left font-semibold">Product</th>
                        <th class="text-left font-semibold">Add to Cart</th>
                        <th class="text-left font-semibold">Remove</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($wishlist_items as $item)
                    <tr wire:key='{{ $item['product_id'] }}'>
                        <!-- PRODUCT -->
                        <td class="py-4">
                            <div class="flex items-center">
                                <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                <span class="font-semibold">{{ $item['name'] }}</span>
                            </div>
                        </td>

                        <!-- ADD TO CART BUTTON -->
                        <td>
                            @if (! $this->isInCart($item['product_id']))
                                <button 
                                    wire:click='addToCart({{ $item['product_id'] }})'
                                    class="bg-green-500 text-white rounded-lg px-3 py-1 border-2 border-green-700 hover:bg-green-600"
                                >
                                    <span wire:loading.remove wire:target='addToCart({{ $item['product_id'] }})'>Add to Cart</span>
                                    <span wire:loading wire:target='addToCart({{ $item['product_id'] }})'>Adding...</span>
                                </button>
                            @else
                                <button 
                                    disabled
                                    class="bg-gray-400 text-white rounded-lg px-3 py-1 border-2 border-gray-600 cursor-not-allowed"
                                >
                                    In Cart
                                </button>
                            @endif
                        </td>

                        <!-- REMOVE BUTTON -->
                        <td>
                            <button 
                                wire:click='removeItem({{ $item['product_id'] }})'
                                class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700"
                            >
                                <span wire:loading.remove wire:target='removeItem({{ $item['product_id'] }})'>Remove</span>
                                <span wire:loading wire:target='removeItem({{ $item['product_id'] }})'>Removing...</span>
                            </button>
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-4xl font-semibold text-slate-500">
                                No Items in Wishlist
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
