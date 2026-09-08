<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('All Users') }}</h2>
            <a href="{{ route('admin.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Admin dashboard</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Name</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Email</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Entries</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="px-3 py-3">{{ $user->name }}</td>
                                        <td class="px-3 py-3">{{ $user->email }}</td>
                                        <td class="px-3 py-3">
                                            @if ($user->is_admin)
                                                <span class="text-indigo-600 dark:text-indigo-400">Administrator</span>
                                            @else
                                                <span class="text-gray-600 dark:text-gray-400">User</span>
                                            @endif
                                            @if ($user->email_verified_at)
                                                <span class="ml-2 text-green-600 dark:text-green-400">Verified</span>
                                            @else
                                                <span class="ml-2 text-amber-600 dark:text-amber-400">Unverified</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3">{{ $user->price_entries_count }}</td>
                                        <td class="px-3 py-3">{{ $user->created_at?->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-3 py-6 text-center text-gray-500">No users found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
