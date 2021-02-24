<?php

namespace App\Http\Controllers;

use App\Models\beneat\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $monthYear = $request->keymonthyear;

        $year = substr($monthYear,0,4);
        $month = substr($monthYear,5,2);

        if (!empty($from)) {
            $array['dataHoliday'] = Holiday::all();

        } else {
            $array['dataHoliday'] = Holiday::select('holiday.*')
            ->where(function($query) use ($year) {
                if(!empty($year)){
                    $query->whereyear('holiday.start_date','=',$year);
                }
            })
            ->where(function($query) use ($month) {
                if(!empty($month)){
                    $query->wheremonth('holiday.start_date','=',$month);
                }
            })
            ->paginate(5);

        }
        return response()->json($array);
    }

    public function store(Request $request)
    {
        $nameholiday = $request->nameholiday;
        $day = $request->day;
        $start_date = $request->datepicker;
        $end_date = $request->datepicker1;

        $dataHoliday = new Holiday;
        $dataHoliday->name = $nameholiday;
        $dataHoliday->start_date = $start_date;
        $dataHoliday->end_date = $end_date;
        $dataHoliday->day = $day;
        $dataHoliday->save();
        return response()->json($dataHoliday);

    }
    public function showUpdate(Request $request, $id)
    {
        $dataHoliday = Holiday::find($id);
        return response()->json($dataHoliday);
    }
    public function update(Request $request, $id)
    {
        $nameholiday = $request->nameholiday;
        $day = $request->day;
        $start_date = $request->datepicker;
        $end_date = $request->datepicker1;

        $dataHoliday = Holiday::find($id);
        $dataHoliday->name = $nameholiday;
        $dataHoliday->start_date = $start_date;
        $dataHoliday->end_date = $end_date;
        $dataHoliday->day = $day;
        $dataHoliday->save();
        return response()->json($dataHoliday);
    }
    public function destroy($id)
    {
        $dataHoliday = Holiday::find($id)->delete();
        return response()->json($dataHoliday);
    }
}
