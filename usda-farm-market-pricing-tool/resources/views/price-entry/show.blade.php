<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Price Entry Details') }}
        </h2>
    </x-slot>

    <div class="py-2 sm:py-6 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<div class="mb-6">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Back') }}
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-x-10 mb-6">
                        <div class="mb-4">
							<h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">County</h3>
							<p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->county }}</p>
						</div>
						<div class="mb-4">
							<h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Farmers Market</h3>
							<p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->farmers_market }}</p>
						</div>
						<div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Crop</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->crop }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Crop Variety</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->variety }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Production Method</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->production_method }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Sales Method</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->sales_method }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Unit</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">{{ $priceEntry->unit }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Price Per Unit</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-400">${{ number_format($priceEntry->price_per_unit, 2) }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <form action="{{ route('price-entry.delete', $priceEntry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this price entry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Delete Price Entry') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
