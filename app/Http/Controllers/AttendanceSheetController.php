<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttendanceSheetCollection;
use App\Imports\AttendanceSheetsImport;
use App\Models\AttendanceSheet;
use Illuminate\Support\Facades\Log;
use PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceSheetController extends Controller
{
    /**
     * Import attendance sheet from specific location.
     * First get the file from the location, then import the file to the database.
     */
    public function importAttendanceSheet()
    {
        try{
            $fileLocation = storage_path('attendance_sheets/2022/8/2022_08_08.xlsx');
            Excel::import(new AttendanceSheetsImport, $fileLocation);
            return response()->json(['success' => 'Attendance sheet imported successfully.']);
        }catch (\Exception $e){
            Log::emergency("File:" . $e->getFile() . " Line:" . $e->getLine() . " Message:" . $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Get attendance sheet with pagination.
     */
    public function getAttendanceReport(Request $request){
        $searchTerm = $request->searchTerm;
        //$attendanceSheets = AttendanceSheet::orderBy('id', 'desc')->paginate(10);
        $query = AttendanceSheet::orderBy('id', 'desc');
        if($searchTerm){
            $query->where('employee_id', 'like', '%' . $searchTerm . '%')
                ->orWhere('department', 'like', '%' . $searchTerm . '%')
                ->orWhere('employee_name', 'like', '%' . $searchTerm . '%');
        }

        $attendanceSheets = $query->paginate(10);
        return new AttendanceSheetCollection($attendanceSheets);
    }

    /**
     * Generate attendance sheet report in PDF format.
     * ->output()
     */
    public function generateAttendanceReport(Request $request)
    {
        $collection = new AttendanceSheetCollection(AttendanceSheet::orderBy('id', 'desc')->get());
        $attendance_report = json_decode($collection->toJson(), true)['data'];
        view()->share('attendance_report',$attendance_report);
        $pdf = PDF::loadView('attendance_report', $attendance_report);
        $pdf->setPaper('a4' , 'portrait');
        return $pdf->output();
    }
}
