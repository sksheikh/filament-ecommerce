<div class="bg-gray-50 min-h-screen">
    {{-- Hero Section --}}
    <section class="bg-slate-900 py-20 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-blue-600/10 blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2 rounded-full"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">We are here to <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Help You</span></h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                Got a question about a product or need help with your order? Our support team is ready to assist you.
            </p>
        </div>
    </section>

    <div class="max-w-[85rem] mx-auto px-4 -mt-16 pb-24 relative z-20">
        <div class="grid lg:grid-cols-12 gap-10 items-start">
            {{-- Contact Information --}}
            <div class="lg:col-span-5 space-y-8">
                <div class="p-8 rounded-[2rem] bg-white shadow-xl border border-gray-100 h-full">
                    <h2 class="text-3xl font-black text-slate-900 mb-10">Direct Support</h2>
                    
                    <div class="space-y-10">
                        <div class="flex gap-6 items-start group">
                            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-400 uppercase tracking-widest text-xs mb-1">Phone Line</h3>
                                <p class="text-xl font-black text-slate-800">+880 1234-567890</p>
                                <p class="text-sm text-slate-500 mt-1 italic">9:00 AM - 10:00 PM (Everyday)</p>
                            </div>
                        </div>

                        <div class="flex gap-6 items-start group">
                            <div class="w-14 h-14 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-400 uppercase tracking-widest text-xs mb-1">Email Support</h3>
                                <p class="text-xl font-black text-slate-800">support@nafisamart.com</p>
                                <p class="text-sm text-slate-500 mt-1 italic">We usually respond within 24 hours.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 items-start group">
                            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-400 uppercase tracking-widest text-xs mb-1">Corporate Office</h3>
                                <p class="text-xl font-black text-slate-800 line-height-tight">House #12, Road #05, Dhanmondi, <br>Dhaka-1209, Bangladesh</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 pt-10 border-t border-gray-100">
                        <h4 class="font-bold text-slate-900 mb-6">Connect with us:</h4>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="w-10 h-10 bg-cyan-500 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Message Form --}}
            <div class="lg:col-span-7">
                <div class="p-8 md:p-12 rounded-[2.5rem] bg-white shadow-2xl overflow-hidden relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/5 rotate-45 translate-x-12 -translate-y-12"></div>
                    
                    <h2 class="text-3xl font-black text-slate-900 mb-8 relative z-10">Send a Message</h2>
                    
                    <form wire:submit.prevent="save" class="space-y-6 relative z-10">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                                <input type="text" wire:model="name" placeholder="John Doe" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                                <input type="email" wire:model="email" placeholder="john@example.com" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Subject</label>
                            <input type="text" wire:model="subject" placeholder="Question about my order" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                            @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">How can we help?</label>
                            <textarea wire:model="message" rows="5" placeholder="Detailed description of your inquiry..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"></textarea>
                            @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full px-8 py-5 bg-blue-600 text-white font-black rounded-2xl shadow-xl hover:bg-blue-700 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                            <span>Relay Message</span>
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>

                        @if (session()->has('status'))
                            <div class="p-4 bg-green-50 text-green-700 rounded-xl font-bold flex items-center gap-2 animate-bounce mt-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ session('status') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
