<?php
namespace App\Exports;
use App\Models\beneat\Leave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LeaveExport implements FromView
{
    public $userId;

    public function __construct($userId)
    {

        $this->userId = $userId;

    }

    public function view(): View
    {

        $leaveData = Leave::select('leave.*','user.name AS nameuser','admin.name AS nameadmin')
        ->leftjoin('user','user.id','=','leave.user_id')
        ->leftjoin('user AS admin','admin.id','=','leave.approve_id')
        ->where(function($query){
            $query->where('leave_status', '=' ,'อนุมัติ')
            ->orwhere('leave_status', '=','ไม่อนุมัติ');
        })
        ->where('user.id','=', $this->userId)
        ->get();
         return view('leavereport', [
             'dataleave' => $leaveData
        ]);
    }
}
