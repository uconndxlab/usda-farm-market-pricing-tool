<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FarmersMarket;
use App\Models\Town;

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

		foreach ($rows as $row) {
			$data = str_getcsv($row);
			$town = Town::where('name', $data[1])->first();
			if (!$town) {
				$town = Town::create(['name' => $data[1]]);
			}
			FarmersMarket::create([
				'name' => $data[0],
				'town_id' => $town->id,
			]);
		}
    }
}
