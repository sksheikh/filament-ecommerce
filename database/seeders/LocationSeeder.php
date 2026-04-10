<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to truncate tables safely
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\Division::truncate();
        \App\Models\District::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $divisions = [
            ['name' => 'Barishal', 'bn_name' => 'বরিশাল'],
            ['name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম'],
            ['name' => 'Dhaka', 'bn_name' => 'ঢাকা'],
            ['name' => 'Khulna', 'bn_name' => 'খুলনা'],
            ['name' => 'Rajshahi', 'bn_name' => 'রাজশাহী'],
            ['name' => 'Rangpur', 'bn_name' => 'রংপুর'],
            ['name' => 'Sylhet', 'bn_name' => 'সিলেট'],
            ['name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ'],
        ];

        foreach ($divisions as $divisionData) {
            $division = \App\Models\Division::create($divisionData);

            $districts = $this->getDistricts($division->name);
            foreach ($districts as $districtData) {
                $district = $division->districts()->create($districtData);
            }
        }
    }

    private function getDistricts($divisionName)
    {
        $districts = [
            'Barishal' => [
                ['name' => 'Barishal', 'bn_name' => 'বরিশাল'],
                ['name' => 'Patuakhali', 'bn_name' => 'পটুয়াখালী'],
                ['name' => 'Bhola', 'bn_name' => 'ভোলা'],
                ['name' => 'Pirojpur', 'bn_name' => 'পিরোজপুর'],
                ['name' => 'Barguna', 'bn_name' => 'বরগুনা'],
                ['name' => 'Jhalokati', 'bn_name' => 'ঝালকাঠি'],
            ],
            'Chattogram' => [
                ['name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম'],
                ['name' => 'Cox\'s Bazar', 'bn_name' => 'কক্সবাজার'],
                ['name' => 'Rangamati', 'bn_name' => 'রাঙ্গামাটি'],
                ['name' => 'Bandarban', 'bn_name' => 'বান্দরবান'],
                ['name' => 'Khagrachhari', 'bn_name' => 'খাগড়াছড়ি'],
                ['name' => 'Feni', 'bn_name' => 'ফেনী'],
                ['name' => 'Lakshmipur', 'bn_name' => 'লক্ষ্মীপুর'],
                ['name' => 'Chandpur', 'bn_name' => 'চাঁদপুর'],
                ['name' => 'Cumilla', 'bn_name' => 'কুমিল্লা'],
                ['name' => 'Noakhali', 'bn_name' => 'নোয়াখালী'],
                ['name' => 'Brahmanbaria', 'bn_name' => 'ব্রাহ্মণবাড়িয়া'],
            ],
            'Dhaka' => [
                ['name' => 'Dhaka City', 'bn_name' => 'ঢাকা সিটি'],
                ['name' => 'Savar-Dhaka', 'bn_name' => 'সাভার-ঢাকা'],
                ['name' => 'Dhamrai-Dhaka', 'bn_name' => 'ধামরাই-ঢাকা'],
                ['name' => 'Demra-Dhaka', 'bn_name' => 'ডেমরা-ঢাকা'],
                ['name' => 'Keraniganj-Dhaka', 'bn_name' => 'কেরানীগঞ্জ-ঢাকা'],
                ['name' => 'Nawabganj-Dhaka', 'bn_name' => 'নবাবগঞ্জ-ঢাকা'],
                ['name' => 'Dohar-Dhaka', 'bn_name' => 'দোহার-ঢাকা'],
                ['name' => 'Gazipur', 'bn_name' => 'গাজীপুর'],
                ['name' => 'Narayanganj', 'bn_name' => 'নারায়ণগঞ্জ'],
                ['name' => 'Tangail', 'bn_name' => 'টাঙ্গাইল'],
                ['name' => 'Kishoreganj', 'bn_name' => 'কিশোরগঞ্জ'],
                ['name' => 'Manikganj', 'bn_name' => 'মানিকগঞ্জ'],
                ['name' => 'Munshiganj', 'bn_name' => 'মুন্সীগঞ্জ'],
                ['name' => 'Rajbari', 'bn_name' => 'রাজবাড়ী'],
                ['name' => 'Madaripur', 'bn_name' => 'মাদারীপুর'],
                ['name' => 'Gopalganj', 'bn_name' => 'গোপালগঞ্জ'],
                ['name' => 'Faridpur', 'bn_name' => 'ফরিদপুর'],
                ['name' => 'Shariatpur', 'bn_name' => 'শরীয়তপুর'],
                ['name' => 'Narsingdi', 'bn_name' => 'নরসিংদী'],
            ],
            'Khulna' => [
                ['name' => 'Khulna', 'bn_name' => 'খুলনা'],
                ['name' => 'Jashore', 'bn_name' => 'যশোর'],
                ['name' => 'Satkhira', 'bn_name' => 'সাতক্ষীরা'],
                ['name' => 'Meherpur', 'bn_name' => 'মেহেরপুর'],
                ['name' => 'Narail', 'bn_name' => 'নড়াইল'],
                ['name' => 'Chuadanga', 'bn_name' => 'চুয়াডাঙ্গা'],
                ['name' => 'Kushtia', 'bn_name' => 'কুষ্টিয়া'],
                ['name' => 'Magura', 'bn_name' => 'মাগুরা'],
                ['name' => 'Bagerhat', 'bn_name' => 'বাগেরহাট'],
                ['name' => 'Jhenaidah', 'bn_name' => 'ঝিনাইদহ'],
            ],
            'Rajshahi' => [
                ['name' => 'Rajshahi', 'bn_name' => 'রাজশাহী'],
                ['name' => 'Chapainawabganj', 'bn_name' => 'চাঁপাইনবাবগঞ্জ'],
                ['name' => 'Naogaon', 'bn_name' => 'নওগাঁ'],
                ['name' => 'Natore', 'bn_name' => 'নাটোর'],
                ['name' => 'Pabna', 'bn_name' => 'পাবনা'],
                ['name' => 'Sirajganj', 'bn_name' => 'সিরাজগঞ্জ'],
                ['name' => 'Bogura', 'bn_name' => 'বগুড়া'],
                ['name' => 'Joypurhat', 'bn_name' => 'জয়পুরহাট'],
            ],
            'Rangpur' => [
                ['name' => 'Rangpur', 'bn_name' => 'রংপুর'],
                ['name' => 'Gaibandha', 'bn_name' => 'গাইবান্ধা'],
                ['name' => 'Nilphamari', 'bn_name' => 'নীলফামারী'],
                ['name' => 'Kurigram', 'bn_name' => 'কুড়িগ্রাম'],
                ['name' => 'Lalmonirhat', 'bn_name' => 'লালমনিরহাট'],
                ['name' => 'Dinajpur', 'bn_name' => 'দিনাজপুর'],
                ['name' => 'Thakurgaon', 'bn_name' => 'ঠাকুরগাঁও'],
                ['name' => 'Panchagarh', 'bn_name' => 'পঞ্চগড়'],
            ],
            'Sylhet' => [
                ['name' => 'Sylhet', 'bn_name' => 'সিলেট'],
                ['name' => 'Moulvibazar', 'bn_name' => 'মৌলভীবাজার'],
                ['name' => 'Habiganj', 'bn_name' => 'হবিগঞ্জ'],
                ['name' => 'Sunamganj', 'bn_name' => 'সুনামগঞ্জ'],
            ],
            'Mymensingh' => [
                ['name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ'],
                ['name' => 'Jamalpur', 'bn_name' => 'জামালপুর'],
                ['name' => 'Netrokona', 'bn_name' => 'নেত্রকোণা'],
                ['name' => 'Sherpur', 'bn_name' => 'শেরপুর'],
            ],
        ];

        return $districts[$divisionName] ?? [];
    }
}
