<?php
namespace App\Exports;
use App\Models\beneat\Time;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CheckinallExport implements FromView
{
    public function view(): View
    {
        $dataTime = Time::select('attendence.*','user.name AS nameuser')
        ->leftjoin('user','user.id','=','attendence.user_id')
        ->get();

         return view('checkall', [
             'datacheckin' =>   $dataTime
        ]);
    }
}