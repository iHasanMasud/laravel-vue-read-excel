<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSheet extends Model
{
    use HasFactory;

    protected $table = 'attendance_sheets';
    protected $fillable = ['employee_id', 'employee_name', 'department', 'attendance_date', 'first_in_time', 'last_out_time'];
    protected $dates = ['attendance_date', 'first_in_time', 'last_out_time'];
}
