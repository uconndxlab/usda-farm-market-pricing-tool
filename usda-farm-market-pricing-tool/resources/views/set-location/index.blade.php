<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Set Location') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('set-location.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="county" class="block text-sm font-medium text-gray-700 dark:text-gray-300">County</label>
                            <select id="county" name="county" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
                                <option value="">Select a county</option>
                                @foreach ($counties as $county)
                                    <option value="{{ $county }}" {{ $county == $currentCounty ? 'selected' : '' }}>{{ $county }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="farmersMarket" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Farmers Market</label>
                            <input id="farmersMarket" name="farmersMarket" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" placeholder="Enter a farmers market" value="{{ $currentFarmersMarket }}">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Set Location') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>