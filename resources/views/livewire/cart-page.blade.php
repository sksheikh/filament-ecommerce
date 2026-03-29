<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4 dark:text-white">Shopping Cart</h1>
    <div class="flex flex-col md:flex-row gap-4">
      <div class="md:w-3/4">
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
          @if(!empty($cart_items) && count($cart_items) > 0)
          <table class="w-full">
            <thead>
              <tr>
                <th class="text-left font-semibold">Product</th>
                <th class="text-left font-semibold">Price</th>
                <th class="text-left font-semibold">Quantity</th>
                <th class="text-left font-semibold">Total</th>
                <th class="text-left font-semibold">Remove</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cart_items as $item)
                <tr wire:key="{{ $item['product_id'] }}">
                    <td class="py-4">
                        <div class="flex items-center">
                        <img
                        class="h-16 w-16 mr-4"
                        src="{{ $item['image'] ? url('storage', $item['image']) : "https://placehold.co/150" }}"
                        alt="{{ $item['name'] }}">
                        <span class="font-semibold">{{ $item['name'] }}</span>
                        </div>
                    </td>
                    <td class="py-4">{{ moneyFormat($item['unit_amount']) }}</td>
                    <td class="py-4">
                        <div class="flex items-center">
                        <button wire:click="decreaseQuantity({{ $item['product_id'] }})" class="border rounded-md py-2 px-4 mr-2 cursor-pointer">-</button>
                        <span class="text-center w-8">{{ $item['quantity'] }}</span>
                        <button wire:click="increaseQuantity({{ $item['product_id'] }})" class="border rounded-md py-2 px-4 ml-2 cursor-pointer">+</button>
                        </div>
                    </td>
                    <td class="py-4">{{ moneyFormat($item['total_amount']) }}</td>
                    <td>
                        <button
                            type="button"
                            wire:click="removeItem({{ $item['product_id'] }})"
                            class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 cursor-pointer"
                            ><span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Remove</span>
                           <span wire:loading  wire:target="removeItem({{ $item['product_id'] }})">Removing...</span>

                        </button>
                    </td>
                </tr>
                @endforeach
              <!-- More product rows -->
            </tbody>
          </table>
          @else
          <div class="flex flex-col items-center justify-center">
            <img src="{{ asset('images/empty-cart.png') }}" alt="Empty Cart" class="w-64 h-64 mb-4">
            <h2 class="text-2xl font-semibold text-slate-600">Your cart is empty!</h2>
            <p class="text-slate-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
            <a href="/products" wire:navigate class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Start Shopping</a>
          </div>
          @endif
        </div>
      </div>
      <div class="md:w-1/4">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold mb-4">Summary</h2>
          <div class="flex justify-between mb-2">
            <span>Subtotal</span>
            <span>{{ moneyFormat($grand_total) }}</span>
          </div>
          {{-- <div class="flex justify-between mb-2">
            <span>Taxes</span>
            <span>{{ moneyFormat(0) }}</span>
          </div> --}}
          <div class="flex justify-between mb-2">
            <span>Shipping</span>
            <span>{{ moneyFormat(0) }}</span>
          </div>
          <hr class="my-2">
          <div class="flex justify-between mb-2">
            <span class="font-semibold">Grand Total</span>
            <span class="font-semibold">{{ moneyFormat($grand_total) }}</span>
          </div>
          @if ($cart_items)
          <a href="/checkout" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full cursor-pointer">Checkout</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
