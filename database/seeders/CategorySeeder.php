<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        if(!Category::exists()){
            Category::create(['id'=> 1,'name' => 'Remessa Parcial']);
            Category::create(['id'=> 2,'name' => 'Remessa']);
        }
    }
}
