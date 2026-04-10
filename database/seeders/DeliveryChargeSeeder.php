<?php

namespace Database\Seeders;

use App\Models\DeliveryCharge;
use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate delivery charges and pivot table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DeliveryCharge::truncate();
        DB::table('delivery_charge_districts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Dhaka City
        $dhakaCity = DeliveryCharge::create([
            'name' => 'Dhaka City',
            'amount' => 60,
            'is_active' => true,
        ]);

        $dhakaCityDistrict = District::where('name', 'Dhaka City')->first();
        if ($dhakaCityDistrict) {
            $dhakaCity->districts()->attach($dhakaCityDistrict->id);
        }

        // 2. Dhaka Sub Area
        $dhakaSubArea = DeliveryCharge::create([
            'name' => 'Dhaka Sub Area',
            'amount' => 80,
            'is_active' => true,
        ]);

        $subAreaNames = [
            'Savar-Dhaka', 
            'Dhamrai-Dhaka', 
            'Demra-Dhaka', 
            'Keraniganj-Dhaka', 
            'Nawabganj-Dhaka', 
            'Dohar-Dhaka', 
            'Gazipur', 
            'Narayanganj'
        ];

        $subAreaDistricts = District::whereIn('name', $subAreaNames)->pluck('id');
        $dhakaSubArea->districts()->attach($subAreaDistricts);

        // 3. Outside Dhaka
        $outsideDhaka = DeliveryCharge::create([
            'name' => 'Outside Dhaka',
            'amount' => 120,
            'is_active' => true,
        ]);

        // Attach all other districts that are not in the first two categories
        $usedDistrictIds = array_merge(
            [$dhakaCityDistrict?->id],
            $subAreaDistricts->toArray()
        );
        $usedDistrictIds = array_filter($usedDistrictIds);

        $otherDistricts = District::whereNotIn('id', $usedDistrictIds)->pluck('id');
        $outsideDhaka->districts()->attach($otherDistricts);
    }
}
