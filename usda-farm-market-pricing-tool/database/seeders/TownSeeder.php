<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Town;
use App\Models\County;
use App\Models\State;
use App\Models\ZipCode;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$csvFile = database_path('data/CT Towns.csv');

		if (!file_exists($csvFile)) {
			throw new \Exception("CSV file not found: $csvFile");
		}

		$csvData = file_get_contents($csvFile);	
		$rows = explode("\n", $csvData);

		foreach ($rows as $row) {
			$data = str_getcsv($row);

			if (count($data) < 4) continue; // Skip empty or invalid rows

			$county = County::where('name', $data[3])->first();
			if (!$county) continue;

			Town::firstOrCreate([
				'name' => $data[2],
				'county_id' => $county->id,
			]);

			$town = Town::where('name', $data[2])->first();
			ZipCode::firstOrCreate([
				'zip_code' => $data[1],
				'town_id' => $town->id,
			]);
		}
    }
}
