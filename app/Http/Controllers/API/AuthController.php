<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        if (!Auth::guard()->attempt($request->only(['email','password']))) {
            return $this->sendError('(خطا في ادخال البيانات الرجاء المحاولة وادخال البيانات الصحيحة )', 'بيانات خاطئة', 200);
        }
        
        $token = Auth::guard()->user()->createToken('AuthToken')->accessToken;
        return $this->sendResponse("تم تسجيل الدخول بنجاح", ['accessToken' => $token]);
    }
}
