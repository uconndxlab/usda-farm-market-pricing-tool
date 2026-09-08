<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('All Price Entries') }}</h2>
            <a href="{{ route('admin.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Admin dashboard</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $entries->count() }} total entries</p>
                        <a href="{{ route('price-entry.export') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Export CSV</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Date</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">User</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Location</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Crop</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Details</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Price</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($entries as $entry)
                                    <tr>
                                        <td class="px-3 py-3 whitespace-nowrap">{{ $entry->date_collected?->format('Y-m-d') ?? '—' }}</td>
                                        <td class="px-3 py-3">{{ $entry->user?->email ?? 'Unknown' }}</td>
                                        <td class="px-3 py-3">{{ $entry->town }}{{ $entry->farmers_market ? ' / '.$entry->farmers_market : '' }}</td>
                                        <td class="px-3 py-3">{{ $entry->crop }}{{ $entry->variety ? ' / '.$entry->variety : '' }}</td>
                                        <td class="px-3 py-3">{{ $entry->production_method }} / {{ $entry->sales_method }} / {{ $entry->unit }}</td>
                                        <td class="px-3 py-3 whitespace-nowrap">${{ number_format($entry->price_per_unit, 2) }}</td>
                                        <td class="px-3 py-3"><a href="{{ route('price-entry.show', $entry->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">View</a></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="px-3 py-6 text-center text-gray-500">No price entries found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
