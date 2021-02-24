<?php

namespace App\Http\Controllers;

use App\Exports\LeaveallExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LeaveallreportController extends Controller
{
      /**
     * @return BinaryFileResponse
     */
    public function export()
    {

        $excel = 'leaveall.xlsx';
        Excel::store(new LeaveallExport, $excel,'temp_upload');

        $filePath = storage_path('uploads') . '/' . $excel;

        return response()->download($filePath, $excel);

    }
}
