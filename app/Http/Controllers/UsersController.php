<?php
namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UsersController extends Controller
{
    /**
     * @return BinaryFileResponse
     */

    public function export()
    {
        // return Excel::download(new UsersExport(), 'users.xlsx');
        $excel = 'holiday.xlsx';
        Excel::store(new UsersExport, $excel,'temp_upload');

        $filePath = storage_path('uploads') . '/' . $excel;

        return response()->download($filePath, $excel);

        // return response()->download($filePath, $boy);
    }
}