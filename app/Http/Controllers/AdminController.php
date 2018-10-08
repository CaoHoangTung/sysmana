<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller{
    // return to user to login as admin
    public function adminform(){
        return view('admin-login');
    }

    // process admin login
    public function adminlogin(Request $req){
        // change this url to where admin infos are contained (json format)
        $url = ("C:\Users\DELL7470\Desktop\work\sub_proj\admin.json");
        $file = file_get_contents($url);
        $arr = json_decode($file);

        if ($req->username === $arr->username && $req->password === $arr->password){
            session(['admin'=>'granted']);
            return redirect("/command");
        }
        return redirect()->back()->withErrors(['Login failed']);
    }
}