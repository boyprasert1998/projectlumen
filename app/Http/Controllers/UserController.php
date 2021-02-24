<?php

namespace App\Http\Controllers;

use App\Models\beneat\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $from = $request->from;
        if (!empty($from)) {
            $userData = User::select('user.*', 'department.name AS namedepartment','quota_use AS boy')
                ->leftjoin('department', 'department.id', '=', 'user.department_id')
                ->leftJoin('quotaleave','quotaleave.user_id','=','user.id')
                ->where(function ($query) use ($keyword) {

                    if (!empty($keyword)) {
                        $query->where('user.name', '=', $keyword)
                            ->orwhere('department.name', '=', $keyword)
                            ->orwhere('user_level', '=', $keyword);
                    }

                })
                ->orderBy('user.id', 'ASC')
                ->get();
        } else {
            $userData = User::select('user.*', 'department.name AS namedepartment')
                ->leftjoin('department', 'department.id', '=', 'user.department_id')
                ->where(function ($query) use ($keyword) {

                    if (!empty($keyword)) {
                        $query->where('user.name', '=', $keyword)
                            ->orwhere('department.name', '=', $keyword)
                            ->orwhere('user_level', '=', $keyword);
                    }

                })
                ->orderBy('user.id', 'ASC')->paginate(5);
        }
        return response()->json($userData);
    }
    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $user_level = $request->user_level;
        $department_id = $request->department_id;

        $userData = new User;
        $userData->name = $name;
        $userData->email = $email;
        $userData->tel = $phone;
        $userData->user_level = $user_level;
        $userData->department_id = $department_id;
        $userData->save();

        return response()->json($userData);
    }
    public function showUpdate(Request $request, $id)
    {
        $userData = User::find($id);
        return response()->json($userData);
    }
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $user_level = $request->user_level;
        $department_id = $request->department_id;

        $userData = User::find($id);
        $userData->name = $name;
        $userData->email = $email;
        $userData->tel = $phone;
        $userData->user_level = $user_level;
        $userData->department_id = $department_id;
        $userData->save();

        return response()->json($userData);
    }
    public function destroy($id)
    {
        $userData = User::find($id)->delete();
        return response()->json($userData);

    }
}