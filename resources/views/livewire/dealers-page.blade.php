<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- PAGE HEADER -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-slate-900">
            Motorcycle Dealers
        </h1>
        <p class="mt-2 text-slate-600 max-w-3xl">
            MotoFinder PH partners with trusted motorcycle dealers to help
            Filipinos discover and purchase their dream motorcycles with ease.
        </p>
    </div>

    <!-- BRANDS LIST -->
    <div class="space-y-8">

        @forelse ($brands as $brand)
            <div class="border rounded-xl p-6">

                <!-- BRAND NAME -->
                <h2 class="text-2xl font-semibold text-slate-800">
                    {{ $brand->name }}
                </h2>

                @if ($brand->products->count())
                    <p class="mt-3 text-sm text-slate-600">
                        Available Models:
                    </p>

                    <!-- PRODUCTS -->
                    <ul class="mt-3 grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($brand->products as $product)
                            <li class="border rounded-lg p-3 text-slate-700">
                                <div class="font-medium">
                                    {{ $product->name }}
                                </div>
                                <div class="text-sm text-slate-500">
                                    {{ Number::currency($product->price, 'USD') }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-sm text-slate-500 italic">
                        No available products at the moment.
                    </p>
                @endif

            </div>
        @empty
            <p class="text-slate-500">
                No dealers available.
            </p>
        @endforelse

    </div>

</div>
