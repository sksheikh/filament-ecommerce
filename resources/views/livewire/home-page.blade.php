<div>
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-blue-50 py-20 md:py-32 ">
        <div class="mx-auto max-w-3xl text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold tracking-tight md:text-6xl ">
            Premium Electronic Gadgets for Modern Life
            </h1>
            <p class="mt-4 mb-8 text-lg">
            Discover the latest phones, laptops, and accessories from top brands. Shop with confidence, no account required.
            </p>

            <!-- Buttons -->
            <div class="mt-7 flex flex-row gap-3 justify-center">
            <a
                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-black text-white hover:bg-slate-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                href="/register"
            >
                Get started
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="m9 18 6-6-6-6" />
                </svg>
            </a>
            <a
                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50"
                href="/contact"
            >
            Shop Now
            </a>
            </div>
        </div>
    </div>



    <section class="w-full bg-gradient-to-r from-blue-50 to-cyan-50 py-16">
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-10">Explore Our Categories</h2>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            @if($categories->count() > 0)
            @foreach($categories as $category)
            <a class="group flex flex-col bg-white border border-transparent hover:border-blue-200 shadow-sm rounded-2xl hover:shadow-md transition-transform hover:-translate-y-1 p-5" href="#" wire:key="{{ $category->id }}">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full ring-2 ring-blue-100" src="{{ $category->image_url }}" alt="{{ $category->name }}">
                        <div class="ms-3">
                        <h3 class="font-semibold text-gray-800 group-hover:text-blue-600">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $category->description }}</p>
                        </div>
                    </div>
                    <div class="text-blue-500 group-hover:translate-x-1 transition-transform">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
            @endif


            </div>
        </div>
    </section>


    <!-- Featured Products -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
            Featured Products
            </h2>
            <p class="text-gray-600 mb-12">
            Discover our best-selling gadgets designed to enhance your everyday life.
            </p>

            <!-- Updated Grid: lg:grid-cols-4 -->
            <div class="flex flex-wrap items-center ">

            @if($featuredProducts->count() > 0)
                @foreach($featuredProducts as $product)
                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/4" wire:key="{{ $product->id }}">
                    <livewire:component.product-card :product="$product" />
                </div>
                @endforeach
            @endif

          </div>
        </div>
    </section>

    <!-- Best Selling Products -->
    <section class="bg-gradient-to-r from-blue-50 to-cyan-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
            Best Selling Products
            </h2>
            <p class="text-gray-600 mb-12">
            Discover our best-selling gadgets designed to enhance your everyday life.
            </p>

            <!-- ✅ Updated Grid: lg:grid-cols-4 -->
            <div class="flex flex-wrap items-center ">

            @if($featuredProducts->count() > 0)
                @foreach($featuredProducts as $product)
                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/4" wire:key="{{ $product->id }}">
                    <livewire:component.product-card :product="$product" />
                </div>
                @endforeach
            @endif

          </div>
        </div>
    </section>






</div>
