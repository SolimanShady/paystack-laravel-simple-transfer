<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            "public_key" => "pk_test_05908a00c176a171fb20102a295cbf26071bdbed",
            "secret_key" => "sk_test_27b0e074e63d60b6cd6470edc19e54d1122b407b"
        ]);
    }
}
