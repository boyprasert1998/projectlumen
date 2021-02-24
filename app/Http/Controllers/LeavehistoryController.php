<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\beneat\Leavehistory;
class LeavehistoryController extends Controller
{
     public function index(Request $request) {
        $keyword = $request->keyword;
        $monthYear = $request->keymonthyear;

        // dd($monthYear);

        $year = substr($monthYear,0,4);
        $month = substr($monthYear,5,2);
        // dd($month);

        $leavehistoryData = Leavehistory::select('leave.*','user.name AS nameuser','admin.name AS nameadmin')
        ->leftjoin('user','user.id','=','leave.user_id')
        ->leftjoin('user AS admin','admin.id','=','leave.approve_id')
        ->where(function($query){
            $query->where('leave_status', '=' ,'อนุมัติ')
            ->orwhere('leave_status', '=','ไม่อนุมัติ');
        })
        ->where(function($query) use ($keyword){
            if(!empty($keyword)) {
                $query->where('user.name','=',$keyword)
                ->orwhere('leave_status', '=',$keyword)
                ->orwhere('leave_type','=',$keyword)
                ->orwhere('admin.name','=',$keyword);
            }
        })
        ->where(function($query) use ($year) {
            if(!empty($year)){
                $query->whereyear('leave.start_date','=',$year);
            }
        })
        ->where(function($query) use ($month) {
            if(!empty($month)){
                $query->wheremonth('leave.start_date','=',$month);
            }
        })
        ->paginate(8);
         return response()->json($leavehistoryData);

     }
}