<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\beneat\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
     public function index(Request $request) {
        // $start = Carbon::parse("2021-02-18");
        // $end = Carbon::parse("2021-02-24");
        // $day = $end->diffInDays($start);

        $leaveData = Leave::select('leave.*','user.name AS nameuser','admin.name AS nameadmin','quota_use')
        ->leftjoin('user','user.id','=','leave.user_id')
        ->leftjoin('user AS admin','admin.id','=','leave.approve_id')
        ->leftjoin('quotaleave','quotaleave.user_id','=','user.id')
        ->where('leave_status','=','อยู่ระหว่างการอนุมัติ')->paginate(5);
         return response()->json($leaveData);
     }

     public function store(Request $request) {
         $user_id = $request->name;
         $userOff = $request->userOff;
         $start_date = $request->datepicker;
         $end_date = $request->datepicker1;
         $leave_type = $request->type;
         $leave_description = $request->description;

        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date ? $end_date: $start_date);


        //  dd($start,$end);

         $days = $end->diffInDays($start);
         $day = $days + 1;


         $leaveData  = new Leave;
         $leaveData->user_id = $user_id;
         $leaveData->manyday = $userOff;
         $leaveData->start_date = $start_date;
         $leaveData->end_date = $end_date;
         $leaveData->leave_type = $leave_type;
         $leaveData->leave_description = $leave_description;
         $leaveData->days = $day;
         $leaveData->save();
         return response()->json($leaveData);
     }

    public function update(Request $request, $id) {
        $admin_id = $request->admin_id;
        $status = $request->statusUpdate;


        $leaveData = Leave::find($id);
        $leaveData->approve_id=$admin_id;
        $leaveData->leave_status = $status;
        $leaveData->save();

        return response()->json($leaveData);
    }
}
