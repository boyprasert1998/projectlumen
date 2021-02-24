<?php

namespace App\Http\Controllers;
use App\Exports\CheckinallExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Illuminate\Http\Request;

class CheckinallreportController extends Controller
{
 /**
     * @return BinaryFileResponse
     */

    public function export()
    {

        $excel = 'checkinall.xlsx';
        Excel::store(new CheckinallExport, $excel,'temp_upload');

        $filePath = storage_path('uploads') . '/' . $excel;

        return response()->download($filePath, $excel);

    }
}