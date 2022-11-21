<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Admins as Model;
use Hash;

class AuthController extends Controller
{

    function login(Request $request)
    {
        if ( "POST" == $request->method() ) {

            $request->validate([
                "email" => "required|email",
                "password" => "required|min:3"
            ]);

            $checkLogin = Model::where([
                "email" => $request->email
            ])->first();

            if ( $checkLogin ) {
                if ( Hash::check($request->password, $checkLogin->password) ) {
                    session()->put("is_admin", 1);
                    foreach ($checkLogin->toArray() as $key => $value) {
                        session()->put($key, $value);
                    }
                    return redirect()->route("admin.index");
                } else {
                    return redirect()->route("auth.login")->with("message", "Login failed");
                }
            } else {
                return redirect()->route("auth.login")->with("message", "Login failed");
            }

        }
        return view("auth.login");
    }

    function logout()
    {
        if ( session()->has("is_admin") ) {
            session()->forget("is_admin");
            session()->flush();
        }
        // Delete all session files
        // $path = config("session.files");
        // if (File::exists($path)) {
        //     $files = File::allFiles($path);
        //     File::delete($files);
        // }
        return redirect()->route("auth.login");
    }
}
