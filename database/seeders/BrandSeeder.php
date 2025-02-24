<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Gucce', 'logo' => 'gucce.png']);
        Brand::create(['name' => 'Lue', 'logo' => 'lue.png']);
    }
}
