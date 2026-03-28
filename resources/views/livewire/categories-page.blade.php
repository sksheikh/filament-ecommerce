<div class="bg-slate-50 min-h-screen">
    {{-- Hero Sector --}}
    <section class="bg-slate-900 py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-blue-600/10 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2 opacity-70"></div>
        <div class="max-w-[85rem] mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-black text-white mb-4">Discover Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Expert Collections</span></h1>
            <p class="text-slate-400 text-lg max-w-xl mx-auto">
                Explore our carefully curated categories designed to provide the best technology experience for your modern life.
            </p>
        </div>
    </section>

    <div class="max-w-[85rem] mx-auto px-4 -mt-10 pb-24 relative z-20">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($categories as $category)
                <a href="/products?selected_categories[0]={{ $category->id }}" 
                   wire:key="cat-{{ $category->id }}"
                   class="group block bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                    
                    {{-- Floating Circle Accent --}}
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        {{-- Icon/Image Container --}}
                        <div class="w-32 h-32 mb-8 bg-slate-50 rounded-full p-6 flex items-center justify-center border border-slate-100 group-hover:bg-white group-hover:shadow-lg transition-all">
                            <img src="{{ $category->image_url }}" 
                                 alt="{{ $category->name }}" 
                                 class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-500">
                        </div>

                        {{-- Category Info --}}
                        <div class="mb-6">
                            <h3 class="text-xl font-black text-slate-800 tracking-tight group-hover:text-blue-600 transition-colors capitalize">
                                {{ $category->name }}
                            </h3>
                            {{-- We can mock product count or use actual if available --}}
                            <p class="text-sm font-bold text-slate-400 mt-2 uppercase tracking-widest italic">
                                Exploring the Future
                            </p>
                        </div>

                        {{-- Action Button --}}
                        <div class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center group-hover:bg-blue-600 transition-colors shadow-lg">
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-400">No Categories Found</h3>
                    <p class="text-slate-300 mt-2">Our team is working on curating new collections for you.</p>
                </div>
            @endforelse
        </div>

        {{-- Help Card --}}
        <div class="mt-20 bg-slate-900 rounded-[3.5rem] p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/20 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight">Can't Find What You're Looking For?</h2>
                <p class="text-slate-400 text-lg mb-12">Search our entire store for the specific gadget you need, or contact us for personalized assistance.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/products" class="px-10 py-5 bg-blue-600 text-white font-black rounded-2xl shadow-xl hover:bg-blue-700 transition-all hover:-translate-y-1">Search Products</a>
                    <a href="/contact" class="px-10 py-5 bg-transparent border border-white text-white font-black rounded-2xl hover:bg-white hover:text-slate-900 transition-all">Support Request</a>
                </div>
            </div>
        </div>
    </div>
</div>
