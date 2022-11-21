<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings as Model;

class SettingsController extends Controller
{
    function index()
    {
        $settings = Model::findOrFail(1);
        return view("admin.settings", ["settings" => $settings]);
    }

    function update(Request $request)
    {
        $settings = Model::findOrFail(1);

        $request->validate([
            "secret_key" => "required",
            "public_key" => "required"
        ]);

        $data = [
            "secret_key" => $request->secret_key,
            "public_key" => $request->public_key
        ];

        if ( $settings->update($data) ) {
            file_put_contents(base_path().'/config/paystack.php',
                '<?php return ' . var_export($data, true) . '; ?>'
                );
            return redirect()->route("settings")->with('message', 'Updated successfully');
        }
    }
}
