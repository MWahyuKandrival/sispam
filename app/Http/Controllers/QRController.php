<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    function index($value = ""){
        return view("test.qr",[
            "value" => $value,
        ]);
    }
}
