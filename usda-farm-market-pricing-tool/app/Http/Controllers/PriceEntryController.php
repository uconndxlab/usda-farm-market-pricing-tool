<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceEntryController extends Controller
{
    public function index(Request $request)
	{
		$states = ["Connecticut", "Maine", "Massachusetts", "New Hampshire", "Rhode Island", "Vermont"];
		$counties = ["Fairfield", "Litchfield", "Hartford", "Tolland", "Windham", "New London", "Middlesex", "New Haven"];
		$farmersMarkets = ["Westport Farmers Market", "New Canaan Farmers Market", "Ridgefield Farmers Market", "Stamford Farmers Market", "Norwalk Farmers Market"];
		$crops = ["Apples", "Tomatoes", "Potatoes", "Carrots"];
		$cropVarieties = ["Granny Smith", "Red Delicious", "Golden Delicious", "Gala", "Fuji", "Honeycrisp"];
		$productionMethods = ["Conventional", "Organic"];
		$salesMethods = ["Wholesale", "Direct To Consumer"];
		$units = ["Bushel", "Crate", "Dozen", "Gallon", "Loaf", "Pound", "Pint", "Quart", "Ton", "Other"];
		return view('price-entry.index', compact('states', 'counties', 'farmersMarkets', 'crops', 'cropVarieties', 'productionMethods', 'salesMethods', 'units'));
	}
}
