<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller{
    function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        return view('settings');
    }

    public function changePassword(Request $req){
        // change this url to where admin infos are contained (json format)
        $url = ("C:\Users\DELL7470\Desktop\work\sub_proj\admin.json");
        $file = file_get_contents($url);
        $arr = json_decode($file);

        $msg1 = "";
        $msg2 = "";
        if($arr->password === $req->password){
            $arr->password = $req->newpassword;
            $f = fopen($url,"w");
            fwrite($f,json_encode($arr));
            fclose($f);
            $msg1 = "Password changed successfully";
        }
        else{
            $msg2 = "Wrong password";
        }

        return redirect()->back()->withErrors([$msg1,$msg2]);

    }

    public function switchSpecialMode(Request $req){
        $to = $req->status;
        if ($to==="1"){
            // turn on
            return "ON";
        }
        else{
            // turn off
            return "OFF";
        }
    }
}