<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\beneat\WorkFromHome;

class WorkFormhomeController extends Controller
{
    public function store(Request $request) {
        $name = $request->name;
        $start_date = $request->datepicker;
        $eng_date = $request->datepicker1;
        $cause = $request->cause;

        $wfh  = new WorkFromHome;
        $wfh->name = $name;
        $wfh->start_date = $start_date;
        $wfh->eng_date = $eng_date;
        $wfh->cause = $cause;
        $wfh->save();
        return response()->json($wfh);
    }
    public function index(){
        $wfh = WorkFromHome :: select('workfromhome.*','admin.name AS nameadmin')
        ->leftjoin('admin','admin.id','=','workfromhome.admin_id')->get();
        return response()->json($wfh);
    }
    public function update(Request $request, $id) {
        $status = $request->statusUpdate;
        $admin_id = $request->admin_id;

        $wfh = WorkFromHome::find($id);
        $wfh->status = $status;
        $wfh->admin_id = $admin_id;
        $wfh->save();

        return response()->json($wfh);
    }
}
