<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="mt-2">
			@if(session('town'))
				<span class="text-sm text-gray-600 dark:text-gray-400">Town: {{ session('town') }}</span>
			@endif
			@if(session('farmersMarket'))
                <span class="text-sm text-gray-600 dark:text-gray-400"> | Farmers Market: {{ session('farmersMarket') }}</span>
            @endif
			@if(session('town') || session('farmersMarket'))
				<a href="{{ route('location.index') }}" class="text-sm text-blue-600 dark:text-blue-400 ml-4">Change</a>
			@endif

        </div>
    </x-slot>

    <div class="py-6 lg:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ session()->has('town') ? route('price-entry.index') : route('location.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ session()->has('town') ? __('Create New Entry') : __('Set Location and Create New Entry') }}
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-2 sm:p-4 lg:p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Your Entries</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
									<th class="px-1 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"></th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Town</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Farmers Market</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Crop</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Variety</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Production Method</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Sales Method</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Unit</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">Price Per Unit</th>
                                    <th class="px-3 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($priceEntries as $entry)
                                <tr>
									<td class="px-1 py-4">
										<a href="{{ route('price-entry.show', $entry->id) }}" class="inline-flex items-center px-1 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
											View
										</a>
									</td>
                                    <td class="px-2 py-4">{{ $entry->town }}</td>
                                    <td class="px-2 py-4">{{ $entry->farmers_market }}</td>
                                    <td class="px-2 py-4">{{ $entry->crop }}</td>
                                    <td class="px-2 py-4 hidden lg:table-cell">{{ $entry->variety }}</td>
                                    <td class="px-2 py-4 hidden lg:table-cell">{{ $entry->production_method }}</td>
                                    <td class="px-2 py-4 hidden lg:table-cell">{{ $entry->sales_method }}</td>
                                    <td class="px-2 py-4 hidden lg:table-cell">{{ $entry->unit }}</td>
                                    <td class="px-2 py-4 hidden lg:table-cell">{{ $entry->price_per_unit }}</td>
                                    <td class="px-1 py-4">
                                        <div class="flex justify-between">
                                            <form action="{{ route('price-entry.delete', $entry->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-1 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>