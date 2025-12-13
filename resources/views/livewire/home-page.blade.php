{{-- resources/views/livewire/homepage.blade.php --}}
<div class="w-full min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <!-- Left Column: Hero Text -->
        <div class="space-y-6">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white">
                Find Your Perfect Ride with <span class="text-blue-600 dark:text-blue-400">MotoShop PH</span>
            </h1>
            <p class="text-gray-700 dark:text-gray-300 text-lg sm:text-xl">
                Browse our catalog of motorcycles, accessories, and parts. Get expert reviews, secure checkout, and guidance to help you choose your dream motorcycle.
            </p>

            <!-- Buttons -->
            <div class="flex flex-wrap gap-4 mt-6">
                <a href="/products" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                    Shop Now &rarr;
                </a>
                <a href="/contact-support" class="px-6 py-3 bg-gray-800 text-white font-semibold rounded-lg shadow hover:bg-gray-700 transition">
                    Contact Support
                </a>
            </div>

            <!-- Ratings -->
            <div class="flex items-center space-x-2 mt-4">
                <div class="flex space-x-1 text-yellow-400">
                    ★★★★★
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">4.6 / 5 – Trusted by Filipino riders</p>
            </div>
        </div>

        <!-- Right Column: Features Text -->
        <div class="space-y-6">
            <div class="flex items-center space-x-3">
                <span class="text-blue-600 text-xl">🏍️</span>
                <p class="text-gray-800 dark:text-gray-300 font-medium">Explore Motorcycles</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-green-500 text-xl">🛠️</span>
                <p class="text-gray-800 dark:text-gray-300 font-medium">Accessories & Parts</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-yellow-500 text-xl">💳</span>
                <p class="text-gray-800 dark:text-gray-300 font-medium">Secure Checkout</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-red-400 text-xl">⭐</span>
                <p class="text-gray-800 dark:text-gray-300 font-medium">Expert Reviews</p>
            </div>
        </div>
    </div>

    <!-- Bottom Features -->
    <div class="mt-16 grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">Fast Delivery</h3>
            <p class="text-gray-700 dark:text-gray-300 text-sm">Receive your motorcycle and accessories quickly and safely.</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">Verified Products</h3>
            <p class="text-gray-700 dark:text-gray-300 text-sm">All motorcycles and parts are quality-checked for your peace of mind.</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">Customer Support</h3>
            <p class="text-gray-700 dark:text-gray-300 text-sm">Our support team is ready to assist you 24/7 with any questions.</p>
        </div>
    </div>
</div>
