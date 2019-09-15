<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Data;

class DataController extends Controller
{ 
    // TODO: Sort Desc.
    public function store(Request $request)
    {
        $emails = [];
        $prsdData = [];
        foreach ($request->data as $entry) {
            array_push($emails, $entry["email"]);
            $entry["name"] = $entry["first_name"]." ".$entry["last_name"];
            $entry["secret"] = Hash::make($entry["secret"]);
            array_push($prsdData, $entry);
        }
        $data = new Data;
        $data->data = $prsdData;
        $data->emails = json_encode($emails);
        $data->request_ip = request()->ip();
        $data->save();
        return $data;
    }

    public function fetch() {
        return Data::all();
    }
}
