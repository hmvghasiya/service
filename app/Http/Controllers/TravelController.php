<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Provider;
use App\Model\Report;
use App\User;
use Carbon\Carbon;

class TravelController extends Controller
{
    public function index($type)
    {
        
        $data['type'] = $type;
        $data['providers'] = Provider::where('type', $type)->where('status', "1")->orderBy('name')->get();
        return view('travel.'.$type)->with($data);
    }

    
}
