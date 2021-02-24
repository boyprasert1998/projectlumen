<?php
namespace App\Http\Controllers;
use App\Models\beneat\Time;
use Illuminate\Http\Request;
class TimeController extends Controller
{
    public function index(Request $request) {
        $keyword = $request->keydates;

        $dataTime = Time::select('attendence.*','user.name AS nameuser')
        ->leftjoin('user','user.id','=','attendence.user_id')
        ->where(function ($query) use ($keyword) {

            if(!empty($keyword)){
            $query->whereDate('attendence.start_date','=',$keyword);
            }
        })->paginate(8);
        return response()->json($dataTime);
    }
    public function store(Request $request) {
        $user_id = $request->user_id;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $date = $request->date;
        if($checkin <= "09:00:00"){
            $status = 'เข้างานตรงเวลา';
        } else {
            $status = 'เข้างานสาย';
        }


        $dataTime = new Time();
        $dataTime->user_id = $user_id;
        $dataTime->start_time = $checkin;
        $dataTime->end_time = $checkout;
        $dataTime->start_date = $date;
        $dataTime->status = $status;
        $dataTime->save();
        return response()->json($dataTime);
    }
    public function showcheckOut(Request $request, $id){
        $dataTime = Time::find($id);
        return response()->json($dataTime);
    }
    public function update(Request $request, $id) {
        $user_id = $request->user_id;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $date = $request->date;

        $dataTime = Time::find($id);
        $dataTime->user_id = $user_id;
        $dataTime->start_time = $checkin;
        $dataTime->end_time = $checkout;
        $dataTime->start_date = $date;
        $dataTime->save();
        return response()->json($dataTime);
    }
    public function destroy($id) {
        $dataTime = Time::find($id)->delete();
        return response()->json($dataTime);
    }
}