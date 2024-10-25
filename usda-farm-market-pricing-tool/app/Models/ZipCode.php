<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

	protected $fillable = ['zip_code', 'town_id'];
	
	public function town()
	{
		return $this->belongsTo(Town::class);
	}
}
