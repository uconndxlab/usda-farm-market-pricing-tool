<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Town;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $towns = [
            'Andover',
            'Ansonia',
            'Ashford',
            'Bantam',
            'Beacon Falls',
            'Bloomfield',
            'Bozrah',
            'Bridgeport',
            'Bristol',
            'Brookfield',
            'Brooklyn',
            'Canton',
            'Colchester',
            'Coventry',
            'Cromwell',
            'Danbury',
            'Danielson',
            'Darien',
            'Durham',
            'East Granby',
            'East Haddam',
            'East Hartford',
            'Ellington',
            'Glastonbury',
            'Granby',
            'Groton',
            'Guilford',
            'Hartford',
            'Higganum',
            'Lebanon',
            'Ledyard',
            'Lisbon',
            'Litchfield',
            'Madison',
            'Manchester',
            'Meriden',
            'Middletown',
            'Milford',
            'Monroe',
            'Naugatuck',
            'New Britain',
            'New Canaan',
            'New Haven',
            'New Milford',
            'Niantic',
            'N. Stonington',
            'Norwalk',
            'Norwich',
            'Old Saybrook',
            'Orange',
            'Plainfield',
            'Putnam',
            'Scotland',
            'Seymour',
            'Shelton',
            'South Windsor',
            'Southbury',
            'Southington',
            'Stafford Springs',
            'Stamford',
            'Storrs',
            'Stratford',
            'Suffield',
            'Tolland',
            'Torrington',
            'Trumbull',
            'Voluntown',
            'West Hartford',
            'West Haven',
            'Westport',
            'Wethersfield',
            'Willimantic',
            'Windsor',
        ];

		foreach ($towns as $town) {
			Town::firstOrCreate(['name' => $town]);
		}
    }
}
