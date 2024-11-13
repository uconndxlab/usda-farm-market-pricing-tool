<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Town;
use App\Models\FarmersMarket;

class LocationSelector extends Component
{
	public $selectedTownId = '';
    public $selectedMarket = '';
    public $customMarket = '';
    public $isCustomMarket = false;
    public $availableMarkets = [];

	public function mount()
	{
		$this->selectedTownId = Town::where('name', session('town'))->value('id') ?? '';
        $this->selectedMarket = session('farmersMarket') ?? '';
		if ($this->selectedTownId) {
			$this->updatedSelectedTownId($this->selectedTownId);
		}
	}


	public function updatedSelectedMarket($value)
	{
		$this->isCustomMarket = $value === 'other';
		if ($this->isCustomMarket) {
			$this->customMarket = '';
		}
	}
	public function updatedSelectedTownId($value)
    {
		$this->isCustomMarket = false;
		$this->customMarket = '';
		$this->selectedMarket = '';

        if ($value) {
            $this->availableMarkets = FarmersMarket::where('town_id', $value)
                ->orderBy('name')
                ->get();
        } else {
            $this->availableMarkets = [];
        }

		$this->dispatch('$refresh');
    }

	public function submit()
	{
		$this->validate([
			'selectedTownId' => 'required|exists:towns,id',
			'selectedMarket' => 'required',
			'customMarket' => $this->isCustomMarket ? 'required|string|max:255' : 'nullable',
		]);

		$town = Town::findOrFail($this->selectedTownId);
		session(['town' => $town->name]);

		if ($this->isCustomMarket) {
			$farmersMarket = FarmersMarket::firstOrCreate([
				'name' => $this->customMarket,
				'town_id' => $town->id
			]);
			session(['farmersMarket' => $farmersMarket->name]);
		} else {
			session(['farmersMarket' => $this->selectedMarket]);
		}

		return redirect()->route('price-entry.index');
	}

    public function render()
    {
        return view('livewire.location-selector', [
			'towns' => Town::orderBy('name')->get(),
		]);
    }
}
