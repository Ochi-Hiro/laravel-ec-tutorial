<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{
    public function showComponent1(){
        $message = 'コントローラーで設定した変数を渡す message';
        return view('umarche_tes.component-test1',
        compact('message'));
    }

    public function showComponent2(){
        return view('umarche_tes.component-test2');
    }
}
