<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\beneat\Calendar;

class CalendarController extends Controller
{
    public function index(Request $request) {
        $id = $request->id;
        // $array['calendarleave']
        // = Calendar::where('leave_status', '=' ,'อนุมัติ')
        // ->get();
        // return response()->json($array);
        if(!empty($id)){
            $array['calendarleave']= Calendar::select('leave.*','user.name AS nameuser')
            ->leftJoin('user','user.id','=','leave.user_id')
            ->leftJoin('department','department.id','=','user.department_id')
            ->where('leave_status', '=' ,'อนุมัติ')->where('department.id','=', $id)->get();
        } else {
            $array['calendarleave']= Calendar::select('leave.*','user.name AS nameuser')
            ->leftJoin('user','user.id','=','leave.user_id')
            ->where('leave_status', '=' ,'อนุมัติ')->get();
        }

        return response()->json($array);
    }
}
