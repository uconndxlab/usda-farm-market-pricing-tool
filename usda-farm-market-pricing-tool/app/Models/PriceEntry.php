<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceEntry extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'town',
		'farmers_market',
		'crop',
		'variety',
		'production_method',
		'sales_method',
		'unit',
		'price_per_unit',
		'date_collected', // Added date_collected field
	];

	protected $casts = [
		'date_collected' => 'date',
		'price_per_unit' => 'decimal:2',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
