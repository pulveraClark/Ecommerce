<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="overflow-hidden bg-white py-11 font-poppins">
    <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">

      <div class="flex flex-wrap -mx-4">
        <!-- Product Images -->
        <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '<?php echo e(url('storage', $product->images[0])); ?>' }">
          <div class="sticky top-0 z-50 overflow-hidden">
            <div class="relative mb-6 lg:mb-10 lg:h-2/4">
              <img x-bind:src="mainImage" alt="" class="object-cover w-full lg:h-full">
            </div>
            <div class="flex-wrap hidden md:flex">
              <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <div class="w-1/2 p-2 sm:w-1/4" x-on:click="mainImage='<?php echo e(url('storage', $image)); ?>'">
                  <img src="<?php echo e(url('storage', $image)); ?>" alt="<?php echo e($product->name); ?>" class="object-cover w-full lg:h-20 cursor-pointer hover:border hover:border-blue-500">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div class="px-6 pb-6 mt-6 border-t border-gray-300">
              <div class="flex flex-wrap items-center mt-6">
                <span class="mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-gray-700 bi bi-truck" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
                  </svg>
                </span>
                <h2 class="text-lg font-bold text-gray-700">Free Shipping</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Product Details -->
        <div class="w-full px-4 md:w-1/2">
          <div class="lg:pl-20">
            <div class="mb-8 [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:ml-4">
              <h2 class="max-w-xl mb-6 text-2xl font-bold md:text-4xl"><?php echo e($product->name); ?></h2>
              <p class="inline-block mb-6 text-4xl font-bold text-gray-700">
                <span><?php echo e(Number::currency($product->price, "USD")); ?></span>
              </p>
              <p class="max-w-md text-gray-700">
                <?php echo Str::markdown($product->description); ?>

              </p>
            </div>

            <!-- Quantity Selector -->
            <div class="w-32 mb-8">
              <label class="w-full pb-1 text-xl font-semibold text-gray-700 border-b border-blue-300">Quantity</label>
              <div class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg">
                <button wire:click='decreaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                  <span class="m-auto text-2xl font-thin">-</span>
                </button>
                <input type="number" wire:model='quantity' readonly class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none text-md hover:text-black" placeholder="1">
                <button wire:click='increaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-400">
                  <span class="m-auto text-2xl font-thin">+</span>
                </button>
              </div>
            </div>

            <!-- Buttons: Add to Cart & Wishlist -->
            <div class="flex flex-wrap gap-4 mt-4">
              <!-- Add to Cart -->
              <button wire:click='addToCart(<?php echo e($product->id); ?>)' class="flex-1 p-4 bg-blue-500 rounded-md text-gray-50 font-semibold hover:bg-blue-600 transition-colors duration-200">
                <span wire:loading.remove wire:target='addToCart(<?php echo e($product->id); ?>)'>Add to Cart</span>
                <span wire:loading wire:target='addToCart(<?php echo e($product->id); ?>)'>Adding...</span>
              </button>

              <!-- Add to Wishlist -->
              <button wire:click="addToWishlist" class="flex-1 flex items-center justify-center gap-2 p-4 bg-pink-500 rounded-md text-white font-semibold hover:bg-pink-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21s-6.318-4.686-9.348-8.013C.74 10.568.25 8.83.25 7.25 0.25 4.35 2.6 2 5.5 2c1.74 0 3.41.81 4.5 2.09C11.09 2.81 12.76 2 14.5 2 17.4 2 19.75 4.35 19.75 7.25c0 1.58-.49 3.318-2.402 5.737C18.318 16.314 12 21 12 21z"/>
                </svg>
                <span wire:loading.remove wire:target="addToWishlist">Add to Wishlist</span>
                <span wire:loading wire:target="addToWishlist">Adding...</span>
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php /**PATH C:\Users\Administrator\Ecommerce\resources\views/livewire/product-detail-page.blade.php ENDPATH**/ ?>