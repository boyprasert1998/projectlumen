<?php
namespace App\Exports;
use App\Models\beneat\Time;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Checkin implements FromView
{
    public $userId;

    public function __construct($userId)
    {

        $this->userId = $userId;

    }
    public function view(): View
    {
        $dataTime = Time::select('attendence.*','user.name AS nameuser')
        ->leftjoin('user','user.id','=','attendence.user_id')
        ->where('user.id','=', $this->userId)
        ->get();

         return view('checkin', [
             'dataCheckin' =>  $dataTime
        ]);
    }
}
