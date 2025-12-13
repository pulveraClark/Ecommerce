<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">

    <section class="flex items-center font-poppins">
        <div class="flex-1 max-w-6xl px-4 py-6 mx-auto bg-white border rounded-md md:py-10 md:px-10">

            <!-- Title -->
            <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-gray-700">
                Thank you! Your order has been received.
            </h1>

            <!-- Shipping Address -->
            <div class="border-b border-gray-200 px-4 mb-8 pb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Shipping Information</h2>

                <div class="space-y-1 text-gray-700">
                    <p class="font-semibold text-lg">
                        {{ $order->address->first_name }} {{ $order->address->last_name }}
                    </p>

                    <p>{{ $order->address->street_address }}</p>
                    <p>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}</p>
                    <p>Phone: {{ $order->address->phone }}</p>
                </div>
            </div>

            <!-- Summary -->
            <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200">

                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="text-sm text-gray-600">Order Number:</p>
                    <p class="text-base font-semibold text-gray-800">{{ $order->id }}</p>
                </div>

                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="text-sm text-gray-600">Date:</p>
                    <p class="text-base font-semibold text-gray-800">
                        {{ $order->created_at->format('m-d-Y') }}
                    </p>
                </div>

                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="text-sm text-gray-600">Total:</p>
                    <p class="text-base font-semibold text-blue-600">
                        {{ Number::currency($order->grand_total) }}
                    </p>
                </div>

                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="text-sm text-gray-600">Payment Method:</p>
                    <p class="text-base font-semibold text-gray-800">
                        {{ $order->payment_method == 'cod' ? 'Cash On Delivery' : 'Card' }}
                    </p>
                </div>

            </div>

            <!-- Order Details -->
            <div class="px-4 mb-10">

                <div class="flex flex-col md:flex-row gap-8">

                    <!-- Left Column -->
                    <div class="flex-1 space-y-6">
                        <h2 class="text-xl font-semibold text-gray-700">Order Details</h2>

                        <div class="border-b border-gray-200 pb-4 space-y-4">

                            <div class="flex justify-between">
                                <p class="text-gray-800">Subtotal</p>
                                <p class="text-gray-600">{{ Number::currency($subtotal) }}</p>
                            </div>

                            <div class="flex justify-between">
                                <p class="text-gray-800">Discount @if($order->coupon_used) ({{ $order->coupon_used }}) @endif</p>
                                <p class="text-gray-600">-{{ Number::currency($order->discount_amount) }}</p>
                            </div>

                            <div class="flex justify-between">
                                <p class="text-gray-800">Shipping</p>
                                <p class="text-gray-600">Free</p>
                            </div>

                        </div>

                        <div class="flex justify-between font-semibold text-gray-800">
                            <p>Total</p>
                            <p>{{ Number::currency($order->grand_total) }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="flex-1 space-y-4 md:px-8">
                        <h2 class="text-xl font-semibold text-gray-700">Shipping Method</h2>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8"
                                         fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M0 3.5A1.5 1.5 0 011.5 2h9A1.5 1.5 0 0112 3.5V5h1.02c.45 0 .875.198 1.17.563l1.48 1.85c.21.26.33.59.33.94v2.65a1.5 1.5 0 01-1.5 1.5H14a2 2 0 11-4 0H5a2 2 0 11-4-.09A1.5 1.5 0 010 10.5v-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-800">Express Delivery</p>
                                    <p class="text-sm text-gray-600">Delivered within 24 hours</p>
                                </div>
                            </div>

                            <p class="text-lg font-semibold text-gray-800">Free</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-start gap-4 px-4 mt-6">
                <a href="/products"
                   class="w-full md:w-auto text-center px-4 py-2 border border-blue-500 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition">
                    Go back shopping
                </a>

                <a href="/my-orders"
                   class="w-full md:w-auto text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    View My Orders
                </a>
            </div>

        </div>
    </section>
</div>
