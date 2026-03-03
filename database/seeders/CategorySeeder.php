<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => '17 agustus lomba',
                'slug' => '17-agustus-lomba',
                'created_at' => now()
            ],
            [
                'name' => 'Class Meeting',
                'slug' => 'class-meeting',
                'created_at' => now()
            ],
            [
                'name' => 'Debat osis',
                'slug' => 'debat-osis',
                'created_at' => now()
            ],
        ]);
    }
}
