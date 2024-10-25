<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\County;
use App\Models\State;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$state = State::where('name', 'Connecticut')->first();

		County::create([
			'name' => 'Unknown',
			'state_id' => $state->id,
		]);

        $counties = [
            'Fairfield', 'Hartford', 'Litchfield', 'Middlesex',
            'New Haven', 'New London', 'Tolland', 'Windham'
        ];

		foreach ($counties as $county) {
			County::create([
				'name' => $county,
				'state_id' => $state->id,
			]);
		}
    }
}
