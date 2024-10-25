<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'state_id'];

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function towns()
	{
		return $this->hasMany(Town::class);
	}
}
