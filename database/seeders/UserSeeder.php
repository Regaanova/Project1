<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            "employe_id" => "EMP001",
            "name" => "admin",
            "phone" => "081234567890",
            "password" => bcrypt("admin123"),
        ]);

        $employe = User::firstOrCreate([
            "employe_id" => "EMP002",
            "name" => "employe",
            "phone"=> "089876543210",
            "password" => bcrypt("employe123"),
        ]);

        $admin->assignRole("admin");
        $employe->assignRole("employe");
    }
}
