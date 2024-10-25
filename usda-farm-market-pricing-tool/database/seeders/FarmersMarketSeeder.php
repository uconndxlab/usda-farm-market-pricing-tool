<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FarmersMarket;
use App\Models\Town;
use App\Models\County;
class FarmersMarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/CT Farmers Market 2024.csv');

		if (!file_exists($csvFile)) {
			throw new \Exception("CSV file not found: $csvFile");
		}

		$csvData = file_get_contents($csvFile);
		$rows = explode("\n", $csvData);

		$unknownCounty = County::where('name', 'Unknown')->first();
		if (!$unknownCounty) {
			throw new \Exception("Unknown county not found");
		}

		// Skip first row as it's the header
		for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $data = str_getcsv($row);
			if (count($data) < 2) continue; // Skip empty or invalid rows

			$town = Town::firstOrCreate(
				['name' => $data[1]],
				['county_id' => $unknownCounty->id]
			);
			
			FarmersMarket::firstOrCreate([
				'name' => $data[0],
				'town_id' => $town->id,
			]);
		}
    }
}
