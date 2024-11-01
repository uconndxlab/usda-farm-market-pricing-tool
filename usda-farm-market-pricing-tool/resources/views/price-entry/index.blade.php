<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Price Entry') }}
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

					@if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('price-entry.store') }}" method="POST">
                        @csrf
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-x-10 mb-2">
							<div>
								<label for="crop" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Crop</label>
								<select id="crop" name="crop" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" required>
									<option value="">Select a crop</option>
									@foreach ($crops as $crop)
										<option value="{{ $crop }}">{{ $crop }}</option>
									@endforeach
								</select>
							</div>
							
							<div>
								<label for="crop_variety" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Crop Variety</label>
								<select id="crop_variety" name="crop_variety" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
									<option value="">Select a crop variety</option>
									@foreach ($cropVarieties as $cropVariety)
										<option value="{{ $cropVariety }}">{{ $cropVariety }}</option>
									@endforeach
								</select>
							</div>

							<div>
								<label for="production_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Production Method</label>
								<select id="production_method" name="production_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" required>
									<option value="">Select a production method</option>
									@foreach ($productionMethods as $method)
										<option value="{{ $method }}">{{ $method }}</option>
									@endforeach
								</select>
							</div>

							<div>
								<label for="sales_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sales Method</label>
								<select id="sales_method" name="sales_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" required>
									<option value="">Select a sales method</option>
									@foreach ($salesMethods as $method)
										<option value="{{ $method }}">{{ $method }}</option>
									@endforeach
								</select>
							</div>
	
							<div>
								<label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit</label>
								<select id="unit" name="unit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" required>
									<option value="">Select a unit</option>
									@foreach ($units as $unit)
										<option value="{{ $unit }}">{{ $unit }}</option>
									@endforeach
								</select>
							</div>

							<div>
								<label for="price_per_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price Per Unit</label>
								<div class="relative mt-1">
									<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600">$</span>
									<input type="number" step="0.01" id="price_per_unit" name="price_per_unit" placeholder="Enter the price per unit" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" inputmode="decimal" required>
								</div>
							</div>
						</div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Add Entry') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>