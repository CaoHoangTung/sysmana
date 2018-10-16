<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandController extends Controller{

    public function __construct(){
        // $this->middleware('admin');
    }

    public function index(){
        return view('command');
    }

    public function executeCommand(Request $req){
        $cmd = $req->cmd;
        $output = array();
        $res = exec($cmd,$output);
        return $output;
    }
   
}