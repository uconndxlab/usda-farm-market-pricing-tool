<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceEntryController extends Controller
{
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
			'crop_id' => 'required|integer',
			'crop_variety' => 'required|string|max:255',
			'production_method' => 'required|string|max:255',
			'sales_method' => 'required|string|max:255',
			'unit' => 'required|string|max:255',
			'price' => 'required|numeric|min:0',
		]);	

		// Save the price entry to the database

		return redirect()->route('price-entry.index')->with('success', 'Price entry saved successfully');
	}
}
