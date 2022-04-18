<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SemesterExport;
use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export($id)
    {
        $semester = Semester::findorFail($id);
        return Excel::download(new SemesterExport($semester), time().'.xlsx');
    }
    
}
