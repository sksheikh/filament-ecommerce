<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="flex items-center font-poppins dark:bg-gray-800 ">
    <div class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto bg-white border rounded-3xl shadow-xl dark:border-gray-900 dark:bg-gray-900 md:py-20 md:px-10 text-center">
      <div>
        <div class="mb-6 flex justify-center">
            <div class="bg-red-50 p-6 rounded-full dark:bg-red-900/20">
                <svg class="h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <h1 class="px-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl mb-4">
            Payment Failed
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
            Something went wrong with your payment. Don't worry, your order has not been charged.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('checkout') }}" class="px-8 py-3 bg-black text-white rounded-xl font-bold hover:bg-gray-800 transition-all transform hover:-translate-y-1">
                Try Again
            </a>
            <a href="/" class="px-8 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all dark:bg-slate-800 dark:text-gray-300 dark:hover:bg-slate-700">
                Back to Home
            </a>
        </div>
      </div>
    </div>
  </section>
</div>
