<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admins;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admins::create([
            "username" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make(123)
        ]);
    }
}
