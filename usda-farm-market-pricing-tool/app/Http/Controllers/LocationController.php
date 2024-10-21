<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Models\FarmersMarket;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
	{
		$towns = Town::orderBy('name')->get();
        $currentTown = $request->session()->get('town', '');
        $currentFarmersMarket = $request->session()->get('farmersMarket', '');
        $farmersMarkets = FarmersMarket::orderBy('name')->get();
        return view('location.index', compact('towns', 'currentTown', 'currentFarmersMarket', 'farmersMarkets'));
	}

	public function store(Request $request)
	{
		$request->validate([
            'town' => 'required|exists:towns,id',
            'farmers_market' => 'nullable|string|max:255',
        ]);

        $town = Town::findOrFail($request->input('town'));
        $request->session()->put('town', $town->name);

        $farmersMarket = FarmersMarket::firstOrCreate(
            ['name' => $request->input('farmers_market'), 'town_id' => $town->id]
        );
        $request->session()->put('farmersMarket', $farmersMarket->name);
        
        return redirect()->route('price-entry.index');
	}

	public function reset(Request $request)
	{
		$request->session()->forget('town');
		$request->session()->forget('farmersMarket');
		return redirect()->route('dashboard');
	}
}
