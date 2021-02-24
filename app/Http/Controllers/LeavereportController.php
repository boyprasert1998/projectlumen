<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LeaveExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LeavereportController extends Controller
{
      /**
     * @return BinaryFileResponse
     */
     public function export(Request $request){
        $id = $request->id;
         $excel = 'leave.xlsx';
         Excel::store(new LeaveExport($id), $excel, 'temp_upload');
         $filePath = storage_path('uploads') .'/'.$excel;
         return response()->download($filePath, $excel);
     }
}
