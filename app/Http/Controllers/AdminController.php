<?php

namespace App\Http\Controllers;
use App\Models\beneat\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(Request $request) {
        $email= $request->email;

        $response['admin'] = Admin::where('email','=', $email)->first();
        return response()->json($response);
    }
}
