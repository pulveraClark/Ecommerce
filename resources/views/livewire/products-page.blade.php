<div class="w-full max-w-340 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins rounded-lg">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
      <div class="flex flex-wrap mb-24 -mx-3">

        <!-- Sidebar Filters -->
        <div class="w-full pr-2 lg:w-1/4 lg:block">

          <!-- Search Bar with Button -->
<div class="mb-6 flex flex-col sm:flex-row gap-2">
    <input 
        type="text" 
        wire:model.defer="search" 
        placeholder="Search products by name, brand..." 
        class="flex-1 p-3 border rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-rose-600 focus:border-rose-600"
    >
    <div class="sm:w-36">
        <button 
            type="button" 
            wire:click="$refresh" 
            class="w-full p-3 bg-rose-600 text-blue-500 rounded-lg shadow-lg hover:bg-rose-700 hover:text-blue-200 text-lg font-semibold transition-all duration-200"
        >
            Search
        </button>
    </div>
</div>

          <!-- Categories -->
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Categories</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <ul>
              @foreach ($categories as $category)
                <li class="mb-4" wire:key="{{ $category->id }}">
                  <label for="{{ $category->slug }}" class="flex items-center">
                    <input type="checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                    <span class="text-lg">{{ $category->name }}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Brands -->
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Brand</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <ul>
              @foreach ($brands as $brand)
                <li class="mb-4" wire:key="{{ $brand->id }}">
                  <label for="{{ $brand->slug }}" class="flex items-center">
                    <input type="checkbox" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}" class="w-4 h-4 mr-2">
                    <span class="text-lg">{{ $brand->name }}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Product Status -->
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Product Status</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <ul>
              <li class="mb-4">
                <label for="featured" class="flex items-center">
                  <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="w-4 h-4 mr-2">
                  <span class="text-lg">Featured Products</span>
                </label>
              </li>
              <li class="mb-4">
                <label for="on_sale" class="flex items-center">
                  <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2">
                  <span class="text-lg">On Sale</span>
                </label>
              </li>
            </ul>
          </div>

          <!-- Price -->
          <div class="p-4 mb-5 bg-white border border-gray-200">
            <h2 class="text-2xl font-bold">Price</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600"></div>
            <div>
              <div class="font-semibold">{{ Number::currency($price_range, 'USD') }}</div>
              <input type="range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer" max="500000" value="300000" step="1000">
              <div class="flex justify-between">
                <span class="inline-block text-lg font-bold text-blue-400">{{ Number::currency(1000, 'USD') }}</span>
                <span class="inline-block text-lg font-bold text-blue-400">{{ Number::currency(500000, 'USD') }}</span>
              </div>
            </div>
          </div>

        </div>

        <!-- Products Grid -->
        <div class="w-full px-3 lg:w-3/4">

          <div class="px-3 mb-4">
            <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex">
              <div class="flex items-center justify-between">
                <select wire:model.live="sort" class="block w-40 text-base bg-gray-100 cursor-pointer">
                  <option value="latest">Sort by latest</option>
                  <option value="price">Sort by Price</option>
                </select>
              </div>
            </div>
          </div>

          <div class="flex flex-wrap items-center">

            @if($no_search_results)
              <div class="w-full mb-6 p-6 bg-yellow-100 text-yellow-800 rounded-lg">
                We don't have that product or brand.
              </div>

              <div class="w-full mb-4 text-lg font-bold">Other alternatives:</div>

              @foreach ($alternative_products as $product)
                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                  <div class="border border-gray-300">
                    <div class="relative bg-gray-200">
                      <a href="/products/{{ $product->slug }}">
                        <img src="{{ url('storage', $product->images[0] ?? '') }}" alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto">
                      </a>
                    </div>
                    <div class="p-3">
                      <h3 class="text-xl font-medium">{{ $product->name }}</h3>
                      <p class="text-lg text-green-600">{{ Number::currency($product->price, 'USD') }}</p>
                    </div>
                  </div>
                </div>
              @endforeach

            @else
              @foreach ($products as $product)
                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                  <div class="border border-gray-300">
                    <div class="relative bg-gray-200">
                      <a href="/products/{{ $product->slug }}">
                        <img src="{{ url('storage', $product->images[0] ?? '') }}" alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto">
                      </a>
                    </div>
                    <div class="p-3">
                      <h3 class="text-xl font-medium">{{ $product->name }}</h3>
                      <p class="text-lg text-green-600">{{ Number::currency($product->price, 'USD') }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

          </div>

          <!-- Pagination -->
          <div class="flex justify-end mt-6">
            {{ $products->links() }}
          </div>

        </div>

      </div>
    </div>
  </section>
</div>
