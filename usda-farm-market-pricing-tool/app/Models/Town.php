<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'county_id'];

	public function county()
	{
		return $this->belongsTo(County::class);
	}

	public function farmersMarkets()
	{
		return $this->hasMany(FarmersMarket::class);
	}
}
