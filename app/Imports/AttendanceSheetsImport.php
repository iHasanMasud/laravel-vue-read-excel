<?php

namespace App\Imports;

use App\Models\AttendanceSheet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendanceSheetsImport implements ToModel, WithStartRow, WithBatchInserts, WithUpsertColumns
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $attendance_date = intval($row[3]);
        $attendance_date = Date::excelToDateTimeObject($attendance_date)->format('Y-m-d');
        $first_in_time = Date::excelToDateTimeObject($row[4])->format($attendance_date.' H:i:s');
        $last_out_time = Date::excelToDateTimeObject($row[5])->format($attendance_date.' H:i:s');

        return new AttendanceSheet([
            'employee_id' => $row[0],
            'employee_name' => $row[1],
            'department' => $row[2],
            'attendance_date' => $attendance_date,
            'first_in_time' => $first_in_time,
            'last_out_time' => $last_out_time,
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function upsertColumns()
    {
        return ['employee_id', 'attendance_date'];
    }
}
