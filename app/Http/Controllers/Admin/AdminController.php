<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins as Model;
use Hash;

class AdminController extends Controller
{
    function account(Request $request)
    {
        $data = Model::findOrFail(1);

        if ( "PUT" == $request->method() ) {

            $request->password = !empty($request->password)
            ? Hash::make($request->password)
            : $request->password_hidden;
            //return $request->password;

            $request->validate([
                "email" => "required|email"
            ]);

            $update = $data->update([
                "email" => $request->email,
                "password" => $request->password
            ]);

            if ( $update ) {
                return redirect()->route("account")->with("message", "Updated successfully");
            }

        }
        return view("admin.account", ["data" => $data]);
    }
}
