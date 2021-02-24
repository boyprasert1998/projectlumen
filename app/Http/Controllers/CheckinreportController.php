<?php

namespace App\Http\Controllers;

use App\Exports\Checkin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CheckinreportController extends Controller
{
    /**
     * @return BinaryFileResponse
     */

    public function export(Request $request)
    {
        $id = $request->id;
        // return Excel::download(new UsersExport(), 'users.xlsx');
        $excel = 'checkin-out.xlsx';
        Excel::store(new Checkin($id), $excel, 'temp_upload');

        $filePath = storage_path('uploads') . '/' . $excel;

        return response()->download($filePath, $excel);

        // return response()->download($filePath, $boy);
    }
}