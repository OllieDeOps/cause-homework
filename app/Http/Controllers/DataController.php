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

        function cmp($a, $b)
        {
            if ($a["age"] == $b["age"]) {
                return 0;
            }
            return ($a["age"] < $b["age"]) ? -1 : 1;
        }
        usort($prsdData, "cmp");

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

    public function delete(Data $data) {
        $data->delete();
        return;
    }
}
