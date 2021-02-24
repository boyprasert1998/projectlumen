<?php

namespace App\Http\Controllers;
use App\Models\beneat\Deparment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeparmentController extends Controller
{
    public function index(Request $request) {
        $from = $request->from;
        if (!empty($from)) {
        $deparmentData = Deparment::all();
         return response()->json($deparmentData);
        } else {
            $deparmentData = Deparment::select('department.*', DB::raw('COUNT(user.department_id) as n'))
            ->leftJoin('user','user.department_id','=','department.id')
            ->groupBy('department.id')
            ->paginate(5);
            return response()->json($deparmentData);
        }
    }


    public function store (Request $request) {
        $name = $request->name;

        $deparmentData = new Deparment;
        $deparmentData->name = $name;
        $deparmentData->save();

        return response()->json($deparmentData);
    }
    public function showUpdate(Request $request,$id) {
        $deparmentData = Deparment::find($id);
        return response()->json($deparmentData);
    }
    public function update (Request $request, $id) {
        $name = $request->name;

        $deparmentData = Deparment::find($id);
        $deparmentData->name = $name;
        $deparmentData->save();
        return response()->json($deparmentData);
    }
    public function destroy($id) {
        $deparmentData = Deparment::find($id)->delete();
        return response()->json($deparmentData);
    }
}