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
					@if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('location.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="town" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Town</label>
                            <select id="town" name="town" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
                                <option value="">Select a town</option>
                                @foreach ($towns as $town)
                                    <option value="{{ $town->id }}" {{ $town->name == $currentTown ? 'selected' : '' }}>{{ $town->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="farmers_market" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Farmers Market</label>
                            <input list="farmers_markets" id="farmers_market" name="farmers_market" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" placeholder="Enter or select a farmers market" value="{{ $currentFarmersMarket }}">
                            <datalist id="farmers_markets">
                                @foreach ($farmersMarkets as $market)
                                    <option value="{{ $market->name }}">
                                @endforeach
                            </datalist>
                        </div>

                        <div class="flex items-center justify-end mt-4">
							<a href="{{ route('location.reset') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('Reset Location') }}
                            </a>
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