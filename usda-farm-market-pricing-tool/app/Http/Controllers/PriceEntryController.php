<?php

namespace App\Http\Controllers;

use App\Models\PriceEntry;
use Illuminate\Http\Request;

class PriceEntryController extends Controller
{
	public function showDashboard(Request $request)
	{
		$user = auth()->user();
		$priceEntries = PriceEntry::where('user_id', $user->id)->get();
		return view('dashboard', compact('priceEntries'));
	}

	public function showPrice(Request $request, $id)
	{
		$priceEntry = PriceEntry::find($id);
		return view('price-entry.show', compact('priceEntry'));
	}

    public function index(Request $request)
	{
		
		$crops = ["Apples", "Tomatoes", "Potatoes", "Carrots"];
		$cropVarieties = ["Granny Smith", "Red Delicious", "Golden Delicious", "Gala", "Fuji", "Honeycrisp"];
		$productionMethods = ["Conventional", "Organic"];
		$salesMethods = ["Wholesale", "Direct To Consumer"];
		$units = ["Bushel", "Crate", "Dozen", "Gallon", "Loaf", "Pound", "Pint", "Quart", "Ton", "Other"];
		return view('price-entry.index', compact( 'crops', 'cropVarieties', 'productionMethods', 'salesMethods', 'units'));
	}

	public function setLocation(Request $request)
	{
		$counties = ["Fairfield", "Litchfield", "Hartford", "Tolland", "Windham", "New London", "Middlesex", "New Haven"];
		$currentCounty = $request->session()->get('county', '');
        $currentFarmersMarket = $request->session()->get('farmersMarket', '');
		return view('set-location.index', compact('counties', 'currentCounty', 'currentFarmersMarket'));
	}

	public function storeLocation(Request $request)
	{
		$request->validate([
			'county' => 'required|string|max:255',
			'farmersMarket' => 'nullable|string|max:255',
		]);

		$request->session()->put('county', $request->input('county'));
        $request->session()->put('farmersMarket', $request->input('farmersMarket'));
		
		return redirect()->route('price-entry.index');
	}

	public function storePrice(Request $request)
	{
		$request->validate([
			'crop' => 'required|string|max:255',
			'crop_variety' => 'required|string|max:255',
			'production_method' => 'required|string|max:255',
			'sales_method' => 'required|string|max:255',
			'unit' => 'required|string|max:255',
			'price_per_unit' => 'required|numeric|min:0',
		]);	

		// Save the price entry to the database
		PriceEntry::create([
			'user_id' => auth()->user()->id,
			'county' => $request->session()->get('county'),
			'farmers_market' => $request->session()->get('farmersMarket'),
			'crop' => $request->input('crop'),
			'variety' => $request->input('crop_variety'),
			'production_method' => $request->input('production_method'),
			'sales_method' => $request->input('sales_method'),
			'unit' => $request->input('unit'),
			'price_per_unit' => $request->input('price_per_unit'),
		]);

		return redirect()->route('price-entry.index')->with('success', 'Price entry saved successfully');
	}

	public function deletePrice(Request $request, $id)
	{
		$priceEntry = PriceEntry::find($id);
		if ($priceEntry->user_id === auth()->user()->id) {
			$priceEntry->delete();
		}
		return redirect()->route('dashboard');
	}
}
