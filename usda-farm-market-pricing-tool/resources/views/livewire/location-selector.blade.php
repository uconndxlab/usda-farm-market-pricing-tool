<div>
    @if ($errors->any())
		<div class="mb-4 text-red-600">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form wire:submit="submit">
		<div class="mb-4">
			<label for="selectedTownId" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Town</label>
            <select wire:model.live="selectedTownId" id="selectedTownId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900">
				<option value="">Select a town</option>
				@foreach ($towns as $town)
					<option value="{{ $town->id }}">{{ $town->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="mb-4">
			<label for="selectedMarket" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Farmers Market</label>
			<select wire:model.live="selectedMarket" id="selectedMarket" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" @disabled(!$selectedTownId)>
				<option value="">Select a market</option>
				@foreach ($availableMarkets as $market)
					<option value="{{ $market->name }}">{{ $market->name }}</option>
				@endforeach
				<option value="other">Other (Add New Market)</option>
			</select>
		</div>

		@if ($isCustomMarket)
			<div class="mb-4">
				<label for="customMarket" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Market Name</label>
				<input wire:model="customMarket" type="text" id="customMarket" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900" placeholder="Enter new market name">
			</div>
		@endif

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
