<?php

namespace Database\Factories;

use App\Models\AttendanceSheet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttendanceSheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttendanceSheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = date('Y-m-d');
        return [
            'attendance_date' => $date,
            'employee_id' => Str::random(5) . "-" . rand(100, 10000),
            'employee_name' => $this->faker->name(),
            'department' => $this->faker->word(),
            'first_in_time' => $date . " " . date('H:i:s', rand(28800, 36000)),
            'last_out_time' => $date . " " . date('H:i:s', rand(54000, 68400)),
        ];
    }
}
