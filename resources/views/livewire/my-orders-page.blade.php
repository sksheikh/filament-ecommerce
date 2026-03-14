<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar -->
        @include('livewire.partials.account-sidebar')

        <!-- Main Content -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-slate-900 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">My Orders</h2>
                </div>

                <div class="p-6">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden border border-gray-100 rounded-lg dark:border-gray-700">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-slate-800">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Order ID</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Date</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Payment Status</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Order Status</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Total Amount</th>
                                                <th scope="col" class="px-6 py-4 text-end text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($orders as $order)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800 dark:text-gray-200">#{{ $order->order_number }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('d M, Y') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $order->payment_status->getColor() == 'success' ? 'bg-green-100 text-green-800' : ($order->payment_status->getColor() == 'danger' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                            {{ $order->payment_status->getLabel() }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $order->status->getColor() == 'success' ? 'bg-green-100 text-green-800' : ($order->status->getColor() == 'info' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                                            {{ $order->status->getLabel() }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">{{ moneyFormat($order->grand_total) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm">
                                                        <a href="/my-orders/{{ $order->id }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-blue-600 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-blue-500 dark:hover:bg-slate-800 transition-all">
                                                            Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400 font-medium">
                                                        You haven't placed any orders yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
