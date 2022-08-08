<?php

namespace App\Http\Resources;

use App\Models\AttendanceSetting;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AttendanceSheetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $attendance_settings = AttendanceSetting::first();

        return [
            'data' => $this->collection->map(function ($data) use ($attendance_settings) {

                // Check late entry & early exit
                if (!$data->first_in_time) {
                    $late_entry = true;
                } else {
                    $late_entry = (strtotime($data->first_in_time->format('H:i:s')) > strtotime($attendance_settings->in_time)) ? true : false;

                }
                if (!$data->last_out_time) {
                    $early_exit = true;
                } else {
                    $early_exit = (strtotime($data->last_out_time->format('H:i:s')) < strtotime($attendance_settings->out_time)) ? true : false;
                }

                // Calculate total working hours
                if ($data->first_in_time && $data->last_out_time) {
                    $diff = $data->last_out_time->diff($data->first_in_time);
                    $hours_of_work = round($diff->s / 3600 + $diff->i / 60 + $diff->h + $diff->days * 24, 2);
                } else {
                    $hours_of_work = 0;
                }

                return [
                    'month' => $data->attendance_date->format('F'),
                    'date' => $data->attendance_date->format('d-M-Y'),
                    'day' => $data->attendance_date->format('l'),
                    'employee_id' => $data->employee_id,
                    'employee_name' => $data->employee_name,
                    'department' => $data->department,
                    'first_in' => ($data->first_in_time) ? $data->first_in_time->format('h:i A') : '',
                    'last_out' => ($data->last_out_time) ? $data->last_out_time->format('h:i A') : '',
                    'hours_of_work' => $hours_of_work,
                    'late_entry' => $late_entry,
                    'early_exit' => $early_exit,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
