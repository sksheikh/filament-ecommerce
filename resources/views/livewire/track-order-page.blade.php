<div class="bg-slate-50 min-h-screen">
    {{-- Hero Section --}}
    <section class="bg-slate-900 py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-blue-600/10 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2 opacity-70"></div>
        <div class="max-w-[85rem] mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-black text-white mb-4">Track Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Order</span></h1>
            <p class="text-slate-400 text-lg max-w-xl mx-auto">
                Enter your order number and phone number below to see the current status of your package.
            </p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 -mt-12 pb-24 relative z-20">
        {{-- Tracking Form --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-12 mb-10 border border-gray-100">
            <form wire:submit.prevent="track" class="grid md:grid-cols-12 gap-6 items-end">
                <div class="md:col-span-4">
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tight">Order Number</label>
                    <input type="text" wire:model="order_number" placeholder="NM-123456" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all font-bold text-slate-900">
                    @error('order_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-4">
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tight">Phone Number</label>
                    <input type="text" wire:model="phone" placeholder="017xxxxxxxx" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all font-bold text-slate-900">
                    @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-4">
                    <button type="submit" class="w-full px-8 py-4 bg-blue-600 text-white font-black rounded-2xl shadow-xl hover:bg-blue-700 transition-all hover:-translate-y-1 flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Track Now
                    </button>
                    <div class="md:hidden h-2"></div> {{-- Spacer for mobile --}}
                </div>
            </form>
        </div>

        {{-- Tracking Results --}}
        @if($order)
            <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100 animate-in fade-in slide-in-from-bottom-5 duration-500">
                {{-- Status Header --}}
                <div class="bg-blue-600 px-8 py-6 flex justify-between items-center text-white">
                    <div>
                        <p class="text-xs uppercase font-bold tracking-[0.2em] opacity-80 mb-1">Status Found</p>
                        <h3 class="text-2xl font-black">{{ $order->status->getLabel() }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-xs uppercase font-bold tracking-[0.2em] opacity-80 mb-1">Order Date</p>
                        <p class="font-bold">{{ $order->created_at->format('d M, Y') }}</p>
                    </div>
                </div>

                <div class="p-8 md:p-12">
                    {{-- Progress Bar --}}
                    <div class="mb-16">
                        <div class="relative flex justify-between items-center">
                            @php
                                $statuses = [
                                    'pending' => ['label' => 'Pending', 'icon' => 'clock'],
                                    'processing' => ['label' => 'Processing', 'icon' => 'refresh'],
                                    'shipped' => ['label' => 'Shipped', 'icon' => 'truck'],
                                    'delivered' => ['label' => 'Delivered', 'icon' => 'check-circle'],
                                ];
                                
                                $currentStatusIndex = array_search($order->status->value, array_keys($statuses));
                                $allStatuses = array_values($statuses);
                            @endphp

                            <div class="absolute top-1/2 left-0 right-0 h-1 bg-slate-100 -translate-y-1/2 z-0 rounded-full"></div>
                            <div class="absolute top-1/2 left-0 h-1 bg-blue-600 -translate-y-1/2 z-0 rounded-full transition-all duration-1000" style="width: {{ ($currentStatusIndex / (count($allStatuses) - 1)) * 100 }}%"></div>

                            @foreach($allStatuses as $index => $stat)
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-full border-4 {{ $index <= $currentStatusIndex ? 'bg-blue-600 border-blue-100 text-white' : 'bg-white border-slate-50 text-slate-300' }} flex items-center justify-center transition-colors duration-500 shadow-sm">
                                        @if($stat['icon'] == 'clock')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @elseif($stat['icon'] == 'refresh')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                        @elseif($stat['icon'] == 'truck')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                        @elseif($stat['icon'] == 'check-circle')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @endif
                                    </div>
                                    <p class="mt-4 text-xs font-black uppercase tracking-widest {{ $index <= $currentStatusIndex ? 'text-blue-600' : 'text-slate-300' }}">{{ $stat['label'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Order Details --}}
                    <div class="grid md:grid-cols-2 gap-12">
                        <div>
                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 border-b border-gray-100 pb-2">Shipping Details</h4>
                            <div class="bg-slate-50 rounded-3xl p-6 border border-gray-100">
                                <p class="font-black text-slate-800 text-lg mb-1">{{ $order->address->full_name }}</p>
                                <p class="text-slate-600 mb-4">{{ $order->address->phone }}</p>
                                <div class="text-slate-500 space-y-1">
                                    <p>{{ $order->address->street_address }}</p>
                                    <p>{{ $order->address->area }}, {{ $order->address->district }}</p>
                                    <p>{{ $order->address->division }} - {{ $order->address->zip_code }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 border-b border-gray-100 pb-2">Order Summary</h4>
                            <ul class="divide-y divide-gray-100">
                                @foreach($order->items as $item)
                                    <li class="py-4 flex gap-4">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex-shrink-0 overflow-hidden border border-gray-100 p-2">
                                            <img src="{{ $item->product->image_urls[0] }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 leading-tight mb-1">{{ $item->product->name }}</p>
                                            <p class="text-sm text-slate-500">Qty: {{ $item->quantity }} x {{ moneyFormat($item->unit_amount) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-6 pt-6 border-t-2 border-slate-100 flex justify-between items-center">
                                <span class="font-bold text-slate-400">Total Paid</span>
                                <span class="text-2xl font-black text-slate-900">{{ moneyFormat($order->grand_total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($searched)
            <div class="bg-red-50 border border-red-100 rounded-[2rem] p-8 text-center animate-in zoom-in duration-300">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-red-900 mb-2">Order Not Found</h3>
                <p class="text-red-700">We couldn't find any order matching the provided details. Please check your order number and phone number and try again.</p>
            </div>
        @endif

        {{-- Help Card --}}
        <div class="mt-12 bg-blue-50 rounded-[2.5rem] p-8 md:p-12 border border-blue-100 flex flex-col md:flex-row items-center gap-8">
            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-blue-600 shadow-sm flex-shrink-0">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h4 class="text-2xl font-black text-blue-900 mb-2">Need Help with Your Order?</h4>
                <p class="text-blue-700 font-medium opacity-80 mb-6">If you have any questions or the tracking information seems incorrect, please contact our support team immediately.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="tel:+8801234567890" class="px-6 py-3 bg-white text-blue-600 rounded-xl font-bold hover:shadow-md transition-shadow">Call Now</a>
                    <a href="/contact" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
