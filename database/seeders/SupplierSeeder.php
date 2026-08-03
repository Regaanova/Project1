<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                "name"=> "ABC Supplier",
                "phone"=> "081234567890",
                "address"=> "Jl. Supplier No. 1, Jakarta",
            ],
            [
                "name"=> "XYZ Supplier",
                "phone"=> "089876543210",
                "address"=> "Jl. Supplier No. 2, Bandung",
            ],
            [
                "name"=> "PQR Supplier",
                "phone"=> "082345678901",
                "address"=> "Jl. Supplier No. 3, Surabaya",
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate($supplier);
        }
    }
}
