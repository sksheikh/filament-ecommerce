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
        \App\Models\Area::truncate();
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
                
                // Adding sample areas for each district
                $areas = $this->getSampleAreas($district->name);
                foreach ($areas as $areaData) {
                    $district->areas()->create($areaData);
                }
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
                ['name' => 'Dhaka', 'bn_name' => 'ঢাকা'],
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

    private function getSampleAreas($districtName)
    {
        $sampleAreas = [
            'Dhaka' => [
                ['name' => 'Adabor', 'bn_name' => 'আদাবর'],
                ['name' => 'Badda', 'bn_name' => 'বাড্ডা'],
                ['name' => 'Banani', 'bn_name' => 'বনানী'],
                ['name' => 'Bangsal', 'bn_name' => 'বংশাল'],
                ['name' => 'Bimanbandar', 'bn_name' => 'বিমানবন্দর'],
                ['name' => 'Cantonment', 'bn_name' => 'ক্যান্টনমেন্ট'],
                ['name' => 'Chak Bazar', 'bn_name' => 'চকবাজার'],
                ['name' => 'Dakshinkhan', 'bn_name' => 'দক্ষিণখান'],
                ['name' => 'Darus Salam', 'bn_name' => 'দারুস সালাম'],
                ['name' => 'Demra', 'bn_name' => 'ডেমরা'],
                ['name' => 'Dhamrai', 'bn_name' => 'ধামরাই'],
                ['name' => 'Dhanmondi', 'bn_name' => 'ধানমণ্ডি'],
                ['name' => 'Dohar', 'bn_name' => 'দোহার'],
                ['name' => 'Gendaria', 'bn_name' => 'গেন্ডারিয়া'],
                ['name' => 'Gulshan', 'bn_name' => 'গুলশান'],
                ['name' => 'Hazaribagh', 'bn_name' => 'হাজারীবাগ'],
                ['name' => 'Jatrabari', 'bn_name' => 'যাত্রাবাড়ী'],
                ['name' => 'Kadamtali', 'bn_name' => 'কদমতলী'],
                ['name' => 'Kafrul', 'bn_name' => 'কাফরুল'],
                ['name' => 'Kalabagan', 'bn_name' => 'কলাবাগান'],
                ['name' => 'Kamrangirchar', 'bn_name' => 'কামরাঙ্গীরচর'],
                ['name' => 'Keraniganj', 'bn_name' => 'কেরানীগঞ্জ'],
                ['name' => 'Khilgaon', 'bn_name' => 'খিলগাঁও'],
                ['name' => 'Khilkhet', 'bn_name' => 'খিলক্ষেত'],
                ['name' => 'Kotwali', 'bn_name' => 'কোতোয়ালী'],
                ['name' => 'Lalbagh', 'bn_name' => 'লালবাগ'],
                ['name' => 'Mirpur', 'bn_name' => 'মিরপুর'],
                ['name' => 'Mohammadpur', 'bn_name' => 'মোহাম্মদপুর'],
                ['name' => 'Motijheel', 'bn_name' => 'মতিঝিল'],
                ['name' => 'Mughda', 'bn_name' => 'মুগদা'],
                ['name' => 'Nawabganj', 'bn_name' => 'নবাবগঞ্জ'],
                ['name' => 'New Market', 'bn_name' => 'নিউ মার্কেট'],
                ['name' => 'Pallabi', 'bn_name' => 'পল্লবী'],
                ['name' => 'Paltan', 'bn_name' => 'পল্টন'],
                ['name' => 'Ramna', 'bn_name' => 'রমনা'],
                ['name' => 'Rampura', 'bn_name' => 'রামপুরা'],
                ['name' => 'Sabujbagh', 'bn_name' => 'সবুজবাগ'],
                ['name' => 'Savar', 'bn_name' => 'সাভার'],
                ['name' => 'Shah Ali', 'bn_name' => 'শাহ আলী'],
                ['name' => 'Shahbagh', 'bn_name' => 'শাহবাগ'],
                ['name' => 'Sher-e-Bangla Nagar', 'bn_name' => 'শেরেবাংলা নগর'],
                ['name' => 'Shyampur', 'bn_name' => 'শ্যামপুর'],
                ['name' => 'Sutrapur', 'bn_name' => 'সূত্রাপুর'],
                ['name' => 'Tejgaon', 'bn_name' => 'তেজগাঁও'],
                ['name' => 'Tejgaon Industrial Area', 'bn_name' => 'তেজগাঁও শিল্পাঞ্চল'],
                ['name' => 'Turag', 'bn_name' => 'তুরাগ'],
                ['name' => 'Uttar Khan', 'bn_name' => 'উত্তরখান'],
                ['name' => 'Uttara', 'bn_name' => 'উত্তরা'],
                ['name' => 'Vatara', 'bn_name' => 'ভাটারা'],
                ['name' => 'Wari', 'bn_name' => 'ওয়ারী'],
            ],
            'Chattogram' => [
                ['name' => 'Akbar Shah', 'bn_name' => 'আকবর শাহ'],
                ['name' => 'Anwara', 'bn_name' => 'আনোয়ারা'],
                ['name' => 'Bakalia', 'bn_name' => 'বাকলিয়া'],
                ['name' => 'Bandar', 'bn_name' => 'বন্দর'],
                ['name' => 'Banshkhali', 'bn_name' => 'বাঁশখালী'],
                ['name' => 'Bayazid Bostami', 'bn_name' => 'বায়েজিদ বোস্তামী'],
                ['name' => 'Boalkhali', 'bn_name' => 'বোয়ালখালী'],
                ['name' => 'Chandanaish', 'bn_name' => 'চন্দনাইশ'],
                ['name' => 'Chandgaon', 'bn_name' => 'চাঁদগাঁও'],
                ['name' => 'Chawkbazar', 'bn_name' => 'চকবাজার'],
                ['name' => 'Double Mooring', 'bn_name' => 'ডবলমুরিং'],
                ['name' => 'EPZ', 'bn_name' => 'ইপিজেড'],
                ['name' => 'Fatickchhari', 'bn_name' => 'ফটিকছড়ি'],
                ['name' => 'Halishahar', 'bn_name' => 'হালিশহর'],
                ['name' => 'Hathazari', 'bn_name' => 'হাটহাজারী'],
                ['name' => 'Karnaphuli', 'bn_name' => 'কর্ণফুলী'],
                ['name' => 'Khulshi', 'bn_name' => 'খুলশী'],
                ['name' => 'Kotwali', 'bn_name' => 'কোতোয়ালী'],
                ['name' => 'Lohagara', 'bn_name' => 'লোহাগাড়া'],
                ['name' => 'Mirsharai', 'bn_name' => 'মীরসরাই'],
                ['name' => 'Pahartali', 'bn_name' => 'পাহাড়তলী'],
                ['name' => 'Panchlaish', 'bn_name' => 'পাঁচলাইশ'],
                ['name' => 'Patenga', 'bn_name' => 'পতেঙ্গা'],
                ['name' => 'Patiya', 'bn_name' => 'পটিয়া'],
                ['name' => 'Rangunia', 'bn_name' => 'রাঙ্গুনিয়া'],
                ['name' => 'Raozan', 'bn_name' => 'রাউজান'],
                ['name' => 'Sandwip', 'bn_name' => 'সন্দ্বীপ'],
                ['name' => 'Satkania', 'bn_name' => 'সাতকানিয়া'],
                ['name' => 'Sitakunda', 'bn_name' => 'সীতাকুণ্ড'],
            ],
            'Gazipur' => [
                ['name' => 'Gazipur Sadar', 'bn_name' => 'গাজীপুর সদর'],
                ['name' => 'Kaliakair', 'bn_name' => 'কালিয়াকৈর'],
                ['name' => 'Kaliganj', 'bn_name' => 'কালীগঞ্জ'],
                ['name' => 'Kapasia', 'bn_name' => 'কাপাসিয়া'],
                ['name' => 'Sreepur', 'bn_name' => 'শ্রীপুর'],
            ],
            'Narayanganj' => [
                ['name' => 'Narayanganj Sadar', 'bn_name' => 'নারায়ণগঞ্জ সদর'],
                ['name' => 'Araihazar', 'bn_name' => 'আড়াইহাজার'],
                ['name' => 'Bandar', 'bn_name' => 'বন্দর'],
                ['name' => 'Rupganj', 'bn_name' => 'রূপগঞ্জ'],
                ['name' => 'Sonargaon', 'bn_name' => 'সোনারগাঁও'],
            ],
            'Cumilla' => [
                ['name' => 'Cumilla Sadar', 'bn_name' => 'কুমিল্লা সদর'],
                ['name' => 'Barura', 'bn_name' => 'বরুড়া'],
                ['name' => 'Brahmanpara', 'bn_name' => 'ব্রাহ্মণপাড়া'],
                ['name' => 'Burichang', 'bn_name' => 'বুড়িচং'],
                ['name' => 'Chandina', 'bn_name' => 'চান্দিনা'],
                ['name' => 'Chauddagram', 'bn_name' => 'চৌদ্দগ্রাম'],
                ['name' => 'Daudkandi', 'bn_name' => 'দাউদকান্দি'],
                ['name' => 'Debidwar', 'bn_name' => 'দেবিদ্বার'],
                ['name' => 'Homna', 'bn_name' => 'হোমনা'],
                ['name' => 'Laksham', 'bn_name' => 'লাকসাম'],
                ['name' => 'Monohargonj', 'bn_name' => 'মনোহরগঞ্জ'],
                ['name' => 'Meghna', 'bn_name' => 'মেঘনা'],
                ['name' => 'Muradnagar', 'bn_name' => 'মুরাদনগর'],
                ['name' => 'Nangalkot', 'bn_name' => 'নাঙ্গলকোট'],
                ['name' => 'Titas', 'bn_name' => 'তিতাস'],
            ],
            'Sylhet' => [
                ['name' => 'Sylhet Sadar', 'bn_name' => 'সিলেট সদর'],
                ['name' => 'Beanibazar', 'bn_name' => 'বিয়ানীবাজার'],
                ['name' => 'Bishwanath', 'bn_name' => 'বিশ্বনাথ'],
                ['name' => 'Dakshin Surma', 'bn_name' => 'দক্ষিণ সুরমা'],
                ['name' => 'Fenchuganj', 'bn_name' => 'ফেঞ্চুগঞ্জ'],
                ['name' => 'Golapganj', 'bn_name' => 'গোলাপগঞ্জ'],
                ['name' => 'Gowainghat', 'bn_name' => 'গোয়াইনঘাট'],
                ['name' => 'Jaintiapur', 'bn_name' => 'জৈন্তাপুর'],
                ['name' => 'Kanaighat', 'bn_name' => 'কানাইঘাট'],
                ['name' => 'Zakiganj', 'bn_name' => 'জকিগঞ্জ'],
            ],
            'Rajshahi' => [
                ['name' => 'Rajshahi Sadar', 'bn_name' => 'রাজশাহী সদর'],
                ['name' => 'Bagha', 'bn_name' => 'বাঘা'],
                ['name' => 'Bagmara', 'bn_name' => 'বাগমারা'],
                ['name' => 'Charghat', 'bn_name' => 'চারঘাট'],
                ['name' => 'Durgapur', 'bn_name' => 'দুর্গাপুর'],
                ['name' => 'Godagari', 'bn_name' => 'গোদাগাড়ী'],
                ['name' => 'Mohanpur', 'bn_name' => 'মোহনপুর'],
                ['name' => 'Paba', 'bn_name' => 'পবা'],
                ['name' => 'Puthia', 'bn_name' => 'পুঠিয়া'],
                ['name' => 'Tanore', 'bn_name' => 'তানোর'],
            ],
            'Khulna' => [
                ['name' => 'Khulna Sadar', 'bn_name' => 'খুলনা সদর'],
                ['name' => 'Batiaghata', 'bn_name' => 'বটিয়াঘাটা'],
                ['name' => 'Dacope', 'bn_name' => 'দাকোপ'],
                ['name' => 'Dumuria', 'bn_name' => 'ডুমুরিয়া'],
                ['name' => 'Dighalia', 'bn_name' => 'দিঘলিয়া'],
                ['name' => 'Koyra', 'bn_name' => 'কয়রা'],
                ['name' => 'Paikgachha', 'bn_name' => 'পাইকগাছা'],
                ['name' => 'Phultala', 'bn_name' => 'ফুলতলা'],
                ['name' => 'Rupsha', 'bn_name' => 'রূপসা'],
                ['name' => 'Terokhada', 'bn_name' => 'তেরখাদা'],
            ],
            'Barishal' => [
                ['name' => 'Barishal Sadar', 'bn_name' => 'বরিশাল সদর'],
                ['name' => 'Agailjhara', 'bn_name' => 'আগৈলঝাড়া'],
                ['name' => 'Babuganj', 'bn_name' => 'বাবুগঞ্জ'],
                ['name' => 'Bakerganj', 'bn_name' => 'বাকেরগঞ্জ'],
                ['name' => 'Banaripara', 'bn_name' => 'বানারীপাড়া'],
                ['name' => 'Gaurnadi', 'bn_name' => 'গৌরনদী'],
                ['name' => 'Hizla', 'bn_name' => 'হিজলা'],
                ['name' => 'Mehendiganj', 'bn_name' => 'মেহেন্দিগঞ্জ'],
                ['name' => 'Muladi', 'bn_name' => 'মুলাদী'],
                ['name' => 'Wazirpur', 'bn_name' => 'উজিরপুর'],
            ],
            'Rangpur' => [
                ['name' => 'Rangpur Sadar', 'bn_name' => 'রংপুর সদর'],
                ['name' => 'Badarganj', 'bn_name' => 'বদরগঞ্জ'],
                ['name' => 'Gangachara', 'bn_name' => 'গঙ্গাচড়া'],
                ['name' => 'Kaunia', 'bn_name' => 'কাউনিয়া'],
                ['name' => 'Mithapukur', 'bn_name' => 'মিঠাপুকুর'],
                ['name' => 'Pirgachha', 'bn_name' => 'পীরগাছা'],
                ['name' => 'Pirganj', 'bn_name' => 'পীরগঞ্জ'],
                ['name' => 'Taraganj', 'bn_name' => 'তারাগঞ্জ'],
            ],
            'Mymensingh' => [
                ['name' => 'Mymensingh Sadar', 'bn_name' => 'ময়মনসিংহ সদর'],
                ['name' => 'Bhaluka', 'bn_name' => 'ভালুকা'],
                ['name' => 'Dhobaura', 'bn_name' => 'ধোবাউড়া'],
                ['name' => 'Fulbaria', 'bn_name' => 'ফুলবাড়ীয়া'],
                ['name' => 'Gafargaon', 'bn_name' => 'গফরগাঁও'],
                ['name' => 'Gauripur', 'bn_name' => 'গৌরীপুর'],
                ['name' => 'Haluaghat', 'bn_name' => 'হালুয়াঘাট'],
                ['name' => 'Ishwarganj', 'bn_name' => 'ঈশ্বরগঞ্জ'],
                ['name' => 'Muktagachha', 'bn_name' => 'মুক্তাগাছা'],
                ['name' => 'Nandail', 'bn_name' => 'নান্দাইল'],
                ['name' => 'Phulpur', 'bn_name' => 'ফুলপুর'],
                ['name' => 'Trishal', 'bn_name' => 'ত্রিশাল'],
            ],
            // Default generic "Sadar" area for others
            'default' => [
                ['name' => $districtName . ' Sadar', 'bn_name' => $districtName . ' সদর'],
            ]
        ];

        return $sampleAreas[$districtName] ?? $sampleAreas['default'];
    }
}
