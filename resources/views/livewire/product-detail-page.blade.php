<div class="bg-slate-50 min-h-screen">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-20">
        {{-- Product Main Display --}}
        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-slate-100 p-8 md:p-16 mb-20 relative">
            {{-- Abstract Pattern Background --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
            
            <div class="grid lg:grid-cols-2 gap-16 relative z-10">
                {{-- Left: Image Gallery --}}
                <div x-data="{ activeImage: '{{ count($product->image_urls) > 0 ? $product->image_urls[0] : asset('images/default-image.png') }}' }">
                    <div class="bg-slate-50 rounded-[2.5rem] p-4 mb-6 group overflow-hidden border border-slate-100 shadow-inner">
                        <img :src="activeImage" alt="{{ $product->name }}" 
                             class="w-full h-[400px] object-contain transition-transform duration-700 group-hover:scale-110">
                    </div>
                    
                    @if(count($product->image_urls) > 1)
                    <div class="flex gap-4 overflow-x-auto pb-2 custom-scrollbar">
                        @foreach($product->image_urls as $url)
                        <button @click="activeImage = '{{ $url }}'" 
                                :class="activeImage === '{{ $url }}' ? 'border-blue-600 ring-2 ring-blue-100' : 'border-slate-100 hover:border-blue-300'"
                                class="flex-shrink-0 w-24 h-24 bg-white border-2 rounded-2xl overflow-hidden transition-all duration-300 shadow-sm p-1">
                            <img src="{{ $url }}" class="w-full h-full object-cover rounded-xl" alt="Gallery image">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Right: Product Details --}}
                <div class="flex flex-col">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                            {{ $product->category->name ?? 'Gadget' }}
                        </span>
                        @if($product->on_sale)
                        <span class="px-3 py-1 bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                            Sale Active
                        </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 leading-tight">
                        {{ $product->name }}
                    </h1>

                    @if($product->short_description)
                    <p class="text-slate-500 text-base mb-6 leading-relaxed border-l-4 border-blue-400 pl-4">
                        {{ $product->short_description }}
                    </p>
                    @endif

                    <div class="flex flex-wrap items-center gap-4 mb-8">
                        @if($product->discount_price)
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-blue-600">
                                {{ moneyFormat($product->discount_price) }}
                            </span>
                            <span class="text-base text-slate-400 line-through">
                                {{ moneyFormat($product->price) }}
                            </span>
                        </div>
                        <span class="px-3 py-1 bg-red-100 text-red-600 text-xs font-black rounded-full">
                            {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF
                        </span>
                        @else
                        <span class="text-4xl font-black text-blue-600">
                            {{ moneyFormat($product->price) }}
                        </span>
                        @endif

                        @if($product->is_stock)
                        <span class="flex items-center gap-1.5 text-xs font-bold text-green-500 bg-green-50 px-3 py-1 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            In Stock
                            @if($product->stock_quantity > 0)
                            <span class="text-green-400">({{ $product->stock_quantity }} left)</span>
                            @endif
                        </span>
                        @else
                        <span class="flex items-center gap-1.5 text-xs font-bold text-red-500 bg-red-50 px-3 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Out of Stock
                        </span>
                        @endif
                    </div>

                    {{-- Quality Controls & Add to Cart --}}
                    @if($product->is_stock)
                    <div class="mt-auto space-y-6">
                        <div class="flex items-center gap-6">
                            <div class="flex items-center bg-slate-100 rounded-2xl p-1.5 border border-slate-100">
                                <button wire:click="decreaseQuantity" class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-sm text-slate-500 transition-all font-bold">-</button>
                                <input type="text" wire:model="quantity" readonly class="w-12 text-center bg-transparent border-none text-slate-900 font-black focus:ring-0">
                                <button wire:click="increaseQuantity" class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-sm text-slate-500 transition-all font-bold">+</button>
                            </div>
                            <span class="text-slate-400 text-xs font-bold">Adjust quantity to your needs</span>
                        </div>

                        <div class="flex gap-4">
                            <button wire:click="addToCart({{ $product->id }})" 
                                    class="flex-1 bg-slate-900 text-white flex items-center justify-center gap-3 py-5 rounded-2xl font-black shadow-xl hover:bg-blue-600 transition-all active:scale-95 group">
                                <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="w-5 h-5 transition-transform group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span wire:loading wire:target="addToCart({{ $product->id }})" class="w-5 h-5 border-2 border-white rounded-full border-t-transparent animate-spin"></span>
                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to Bag</span>
                                <span wire:loading wire:target="addToCart({{ $product->id }})">Adding to Bag...</span>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Long Description Section --}}
        @if($product->description)
        <div class="bg-white rounded-[2.5rem] shadow-md border border-slate-100 p-8 md:p-12 mb-20">
            <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900">Product Description</h2>
            </div>
            <div class="prose prose-slate prose-lg max-w-none text-slate-600 leading-relaxed">
                {!! Str::markdown($product->description) !!}
            </div>
        </div>
        @endif

        {{-- Related Products Section --}}
        @if($relatedProducts->count() > 0)
        <div class="mb-20">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">
                    People also <span class="text-blue-600 italic">love</span>
                </h2>
                <a href="/products?selected_categories[0]={{ $product->category_id }}" class="text-sm font-black text-slate-400 hover:text-blue-600 transition-colors uppercase tracking-[0.2em]">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <div x-data="{ hover: false }" 
                     @mouseenter="hover = true" @mouseleave="hover = false"
                     class="group bg-white rounded-[2.5rem] border border-slate-100 p-6 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 flex flex-col items-center text-center">
                    
                    <a href="/products/{{ $related->slug }}" class="w-full relative mb-6">
                        <div class="aspect-square bg-slate-50 rounded-[2rem] p-6 flex items-center justify-center group-hover:bg-white transition-colors duration-500 overflow-hidden border border-slate-100">
                             <img src="{{ $related->image_urls[0] }}" alt="{{ $related->name }}" 
                                  class="max-h-full max-w-full object-contain transition-transform duration-700 group-hover:scale-110">
                        </div>
                    </a>

                    <h3 class="text-lg font-black text-slate-800 mb-2 truncate w-full px-2">
                        <a href="/products/{{ $related->slug }}" class="hover:text-blue-600 transition-colors">{{ $related->name }}</a>
                    </h3>
                    <p class="text-blue-600 font-black mb-6">{{ moneyFormat($related->price) }}</p>

                    <button wire:click.prevent="addToCart({{ $related->id }}, 1)" 
                            class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center shadow-lg hover:bg-blue-600 active:scale-95 transition-all">
                        <svg wire:loading.remove wire:target="addToCart({{ $related->id }}, 1)" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span wire:loading wire:target="addToCart({{ $related->id }}, 1)" class="w-4 h-4 border-2 border-white rounded-full border-t-transparent animate-spin"></span>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Help Banner --}}
        <div class="bg-blue-600 rounded-[3.5rem] p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 blur-[100px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative z-10 max-w-2xl mx-auto flex flex-col items-center">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">Need Support With This Purchase?</h2>
                <p class="text-white/80 text-lg mb-12">Our tech experts are here to help you make the best decision for your lifestyle. Contact us 24/7.</p>
                <div class="flex flex-wrap justify-center gap-4 w-full">
                    <a href="/contact" class="flex-1 md:flex-none px-10 py-5 bg-white text-blue-600 font-black rounded-2xl shadow-xl hover:-translate-y-1 transition-all">Chat with an Agent</a>
                    <a href="tel:+880123456789" class="flex-1 md:flex-none px-10 py-5 bg-blue-700 text-white font-black rounded-2xl hover:bg-blue-800 transition-all border border-blue-500/30">Call Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
