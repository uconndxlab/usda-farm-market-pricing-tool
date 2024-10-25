<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

	protected $fillable = ['zip_code'];
	
	public function towns()
	{
		return $this->belongsToMany(Town::class);
	}
}
