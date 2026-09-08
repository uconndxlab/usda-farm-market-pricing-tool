<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Admin Dashboard') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                <a href="{{ route('admin.users') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Users</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $userCount }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $adminCount }} administrators</p>
                </a>
                <a href="{{ route('admin.entries') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Price entries</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $entryCount }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">View every submitted entry</p>
                </a>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
                    <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Recent entries</h3>
                        <a href="{{ route('admin.entries') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View all</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Date</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">User</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Crop</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Location</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($recentEntries as $entry)
                                    <tr>
                                        <td class="px-3 py-3">{{ $entry->date_collected?->format('Y-m-d') ?? '—' }}</td>
                                        <td class="px-3 py-3">{{ $entry->user?->name ?? 'Unknown' }}<span class="block text-xs text-gray-500">{{ $entry->user?->email }}</span></td>
                                        <td class="px-3 py-3">{{ $entry->crop }}</td>
                                        <td class="px-3 py-3">{{ $entry->town }}{{ $entry->farmers_market ? ' / '.$entry->farmers_market : '' }}</td>
                                        <td class="px-3 py-3">${{ number_format($entry->price_per_unit, 2) }} / {{ $entry->unit }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-3 py-6 text-center text-gray-500">No price entries yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
