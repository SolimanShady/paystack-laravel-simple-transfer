<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transfers as Model;

class TransactionController extends Controller
{
    function index()
    {
        $data = Model::orderBy('id', 'desc')->paginate(10);
        return view("admin.transfers", ["data" => $data]);
    }

    function search()
    {
        $search = $_GET["search"];
        $data = Model::select("*")
            ->where(function($query) use ($search){
                $query->where('reference', 'LIKE', '%'.$search.'%')
                ->orWhere('transfer_code', 'LIKE', '%'.$search.'%')
                ->orWhere('amount', 'LIKE', '%'.$search.'%');
            })->orderBy('id', 'desc')->get();

        if ( $data ) {
            return view("admin.search", ["data" => $data]);
        }

    }

    function destroy($id)
    {
        if ( Model::findOrFail($id)->delete() ) {
            return redirect()->route('transactions');
        }
    }
}
