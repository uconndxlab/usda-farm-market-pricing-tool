<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmersMarket extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'town_id'];

	public function town()
	{
		return $this->belongsTo(Town::class);
	}
}
