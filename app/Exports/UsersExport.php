<?php
namespace App\Exports;
use App\Models\beneat\Holiday;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
         return view('test', [
             'dataholiday' =>  Holiday::all()
        ]);
    }
}
