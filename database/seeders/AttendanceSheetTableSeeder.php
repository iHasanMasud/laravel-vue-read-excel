<?php

namespace Database\Seeders;

use App\Models\AttendanceSheet;
use Illuminate\Database\Seeder;

class AttendanceSheetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttendanceSheet::factory()->count(50)->create();
    }
}
