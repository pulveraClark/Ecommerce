<header class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 shadow-md">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
    <div class="relative md:flex md:items-center md:justify-between">
      
      <!-- Brand & Mobile Toggle -->
      <div class="flex items-center justify-between">
        <a class="flex-none text-xl font-semibold text-gray-900" href="/" aria-label="Brand">MotoShop PH</a>
        <div class="md:hidden">
          <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <line x1="3" y1="6" x2="21" y2="6" />
              <line x1="3" y1="12" x2="21" y2="12" />
              <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M18 6L6 18" />
              <path d="M6 6L18 18" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Navbar Links -->
      <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
          <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid">

            <!-- Home -->
            <a class="font-medium py-3 md:py-6 <?php echo e(request()->is('/') ? 'text-blue-600' : 'text-gray-500'); ?>" href="/" aria-current="page">Home</a>

            <!-- Categories -->
            <a class="font-medium py-3 md:py-6 <?php echo e(request()->is('categories*') ? 'text-blue-600' : 'text-gray-500'); ?>" href="/categories">Categories</a>

            <!-- Products -->
            <a class="font-medium py-3 md:py-6 <?php echo e(request()->is('products*') ? 'text-blue-600' : 'text-gray-500'); ?>" href="/products">Products</a>

            <!-- Search Bar -->
            <form action="<?php echo e(route('products.search')); ?>" method="GET" class="flex items-center w-full max-w-xs md:mx-4">
              <input
                type="text"
                name="query"
                value="<?php echo e(request('query')); ?>"
                placeholder="Search products..."
                class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-blue-500"
              />
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600">
                Search
              </button>
            </form>

            <!-- Cart -->
            <a class="font-medium flex items-center py-3 md:py-6 <?php echo e(request()->is('cart*') ? 'text-blue-600' : 'text-gray-500'); ?>" href="/cart">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
              <span class="mr-1">Cart</span>
              <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600"><?php echo e($total_count); ?></span>
            </a>

            <!-- Wishlist -->
            <a class="font-medium flex items-center py-3 md:py-6 <?php echo e(request()->is('wishlist*') ? 'text-red-600' : 'text-gray-500'); ?>" href="/wishlist">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21s-6.318-4.686-9.348-8.013C.74 10.568.25 8.83.25 7.25 0.25 4.35 2.6 2 5.5 2c1.74 0 3.41.81 4.5 2.09C11.09 2.81 12.76 2 14.5 2 17.4 2 19.75 4.35 19.75 7.25c0 1.58-.49 3.318-2.402 5.737C18.318 16.314 12 21 12 21z"/>
              </svg>
              <span class="mr-1">Wishlist</span>
            </a>

            <!-- Login / Auth -->
            <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->guest()): ?>
              <div class="pt-3 md:pt-0">
                <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700" href="/login">Log in</a>
              </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
              <div class="hs-dropdown relative md:py-4">
                <button type="button" class="flex items-center w-full text-gray-500 hover:text-gray-700 font-medium">
                  <?php echo e(auth()->user()->name); ?>

                  <svg class="ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                  </svg>
                </button>
                <div class="hs-dropdown-menu absolute left-0 mt-2 opacity-0 hs-dropdown-open:opacity-100 transition md:w-48 z-10 bg-white shadow-md rounded-lg p-2 border border-gray-200">
                  <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100" href="/my-orders">My Orders</a>
                  <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100" href="/account">My Account</a>
                  <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100" href="/logout">Logout</a>
                </div>
              </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
<?php /**PATH C:\Users\Administrator\Ecommerce\resources\views/livewire/partials/navbar.blade.php ENDPATH**/ ?>