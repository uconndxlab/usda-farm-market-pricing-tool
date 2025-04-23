<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Price Entries') }}
        </h2>
        <div class="mt-2">
            <span class="text-sm text-gray-600 dark:text-gray-400">Town: {{ session('town') }}</span>
            @if(session('farmersMarket'))
                <span class="text-sm text-gray-600 dark:text-gray-400"> | Farmers Market: {{ session('farmersMarket') }}</span>
            @endif
            <a href="{{ route('location.index') }}" class="text-sm text-blue-600 dark:text-blue-400 ml-4">Change</a>
        </div>
    </x-slot>

    <div class="py-2 sm:py-6 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('price-entry.index') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="crop_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Crop</label>
                                <select id="crop_filter" name="crop" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
                                    <option value="">All Crops</option>
                                    @foreach ($crops as $crop)
                                        <option value="{{ $crop }}" {{ request('crop') == $crop ? 'selected' : '' }}>{{ $crop }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="county_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">County</label>
                                <select id="county_filter" name="county" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
                                    <option value="">All Counties</option>
                                    @foreach ($counties as $county)
                                        <option value="{{ $county }}" {{ request('county') == $county ? 'selected' : '' }}>{{ $county }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="production_method_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Production Method</label>
                                <select id="production_method_filter" name="production_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
                                    <option value="">All Methods</option>
                                    @foreach ($productionMethods as $method)
                                        <option value="{{ $method }}" {{ request('production_method') == $method ? 'selected' : '' }}>{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-end">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none">
                                    {{ __('Filter') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">Crop</th>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">Variety</th>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">Production Method</th>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">Sales Method</th>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">Unit</th>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">Price Per Unit</th>
                                    <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-700 dark:text-gray-300">County</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($priceEntries as $entry)
                                    <tr>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">{{ $entry->crop }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">{{ $entry->crop_variety }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">{{ $entry->production_method }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">{{ $entry->sales_method }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">{{ $entry->unit }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">${{ number_format($entry->price_per_unit, 2) }}</td>
                                        <td class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300">{{ $entry->county }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300 text-center">
                                            {{ __('No entries found.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Averages</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-300">Average Price Per Unit: ${{ number_format($averagePrice, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>