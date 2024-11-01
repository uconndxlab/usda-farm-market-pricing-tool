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
		$tree_fruits = ["Apple", "Cherry Sour", "Cherry Sweet", "Nectarine", "Peach", "Pear", "Plum"];
		$small_fruits = ["Blackberry", "Blueberry", "Raspberry", "Strawberry", "Table Grapes"];
		$vegetables = ["Asparagus", "Beans", "Beets", "Broccoli", "Carrot", "Cauliflower", "Celery", "Cucumber", "Eggplant", "Garlic", "Kale", "Lettuce Head", "Lettuce Leaf", "Melon", "Onions", "Peas", "Peppers Hot", "Peppers Sweet", "Radish", "Rhubarb", "Snow Peas", "Spinach", "Squash Summer", "Squash Winter", "Sweet Corn", "Tomato Cherry", "Tomato Heirloom", "Tomato Large"];
		$herbs = ["Lavendar", "Basil", "Chives", "Mints", "Parsley"];
		$crops = array_merge($tree_fruits, $small_fruits, $vegetables, $herbs);
		$cropVarieties = ["Granny Smith", "Red Delicious", "Golden Delicious", "Gala", "Fuji", "Honeycrisp"];
		$productionMethods = ["Conventional", "Organic"];
		$salesMethods = ["Wholesale", "Direct To Consumer"];
		$units = ["Bushel", "Crate", "Dozen", "Gallon", "Loaf", "Pound", "Pint", "Quart", "Ton", "Other"];
		return view('price-entry.index', compact( 'crops', 'cropVarieties', 'productionMethods', 'salesMethods', 'units'));
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
			'town' => $request->session()->get('town'),
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
