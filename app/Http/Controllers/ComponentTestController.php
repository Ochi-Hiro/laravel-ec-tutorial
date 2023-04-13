<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{
    public function showComponent1(){
        return view('umarche_tes.component-test1');
    }

    public function showComponent2(){
        return view('umarche_tes.component-test2');
    }
}
