<footer class="bg-slate-900 border-t border-slate-800">
    <div class="max-w-[85rem] py-12 px-4 sm:px-6 lg:px-8 lg:pt-24 mx-auto">
        <!-- Main Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            <!-- Brand Column -->
            <div class="space-y-6">
                <a class="flex-none text-2xl font-black text-white hover:text-blue-400 transition-colors" href="/" aria-label="Brand">
                    {{ config('app.name') }}<span class="text-blue-500">.</span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed max-w-xs">
                    Elevating your digital lifestyle with premium technology and exceptional service. Join the future of e-commerce.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-800 text-slate-400 hover:bg-blue-600 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-800 text-slate-400 hover:bg-sky-500 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Shop</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="/categories" class="text-slate-400 hover:text-blue-400 transition-colors">Categories</a></li>
                    <li><a href="/products" class="text-slate-400 hover:text-blue-400 transition-colors">All Products</a></li>
                    <li><a href="/products" class="text-slate-400 hover:text-blue-400 transition-colors">Featured Items</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Company</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="/about" class="text-slate-400 hover:text-blue-400 transition-colors">About Us</a></li>
                    <li><a href="/contact" class="text-slate-400 hover:text-blue-400 transition-colors">Contact Us</a></li>
                    <li><a href="/track-order" class="text-slate-400 hover:text-blue-400 transition-colors">Track Order</a></li>
                    <li><a href="/terms" class="text-slate-400 hover:text-blue-400 transition-colors">Terms of Service</a></li>
                    <li><a href="/policy" class="text-slate-400 hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Newsletter</h4>
                <p class="text-slate-400 text-sm mb-4">Subscribe for exclusive offers and tech news.</p>
                <form class="relative group">
                    <input type="email" placeholder="Email address" class="w-full bg-slate-800 border-none rounded-xl py-3 px-4 text-slate-200 placeholder-slate-500 focus:ring-2 focus:ring-blue-600 transition-all">
                    <button class="absolute top-1 right-1 bottom-1 px-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 text-xs">
                © {{ now()->format('Y') }} <span class="text-slate-300 font-bold">{{ config('app.name') }}</span>. All rights reserved.
            </p>
            <div class="flex items-center gap-8 text-xs text-slate-500">
                <span class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    Systems Operational
                </span>
                <div class="flex gap-4 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="h-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-4">
                </div>
            </div>
        </div>
    </div>
</footer>
