<?php

namespace App\Http\Controllers;

class SettingsController extends Controller{
    function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        return view('settings');
    }
}