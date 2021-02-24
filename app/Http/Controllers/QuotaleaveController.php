<?php

namespace App\Http\Controllers;
use App\Models\beneat\Quotaleave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class QuotaleaveController extends Controller
{
    public function index(Request $request){
        $keyword = $request->keyword;

        $quota = Quotaleave::select('quotaleave.*','user.name AS nameuser','department.name AS namedepartment',
        DB::raw('sum(quotaleave.quota_use) AS sum'),
        )->Join('user','user.id', '=','quotaleave.user_id')
        ->leftJoin('leave','leave.user_id', '=','user.id')
        ->leftJoin('department','department.id', '=','user.department_id')
        ->where(function ($query) use ($keyword) {

            if (!empty($keyword)) {
                $query->where('user.name', '=', $keyword)
                    ->orwhere('department.name', '=', $keyword);
            }
        })
        ->groupBy('quotaleave.id')
        ->paginate(5);

        return response()->json($quota);
    }


    public function store (Request $request)
    {
        $id = $request->id;
        $quota = new Quotaleave;
        $quota->user_id = $id;
        $quota->save();

        return response()->json($quota);
    }

    public function quota(Request $request)
    {
        $id = $request->id;
        $days = $request->day;

        $quota =  Quotaleave:: where('user_id','=',$id)->first();
        if($quota) {
            $quota->quota_use = $days + $quota->quota_use;
            $quota->save();
        }
        return response()->json($quota);
    }

}
