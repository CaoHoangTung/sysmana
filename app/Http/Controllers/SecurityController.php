<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityController extends Controller{

    private function getModeStatus($mode){
        // config files is in public/modes.txt
        $fileUrl = "modes.txt";
        $content = file_get_contents($fileUrl);
        $arr = explode("\n",$content);

        for ($i = 0 ; $i < sizeof($arr) ; $i++){
            $curmode = explode("=",$arr[$i]);
            if ($curmode[0] === $mode){
                return $curmode[1][0];
            }
        }
        return 0;
    }

    public function changeModeStatus(Request $req){
        $mode = $req->service;
        $status = $req->status;

        $fileUrl = "modes.txt";
        $content = file_get_contents($fileUrl);
        $arr = explode("\n",$content);
        $res = "";
        for ($i = 0 ; $i < sizeof($arr) ; $i++){
            $curmode = explode("=",$arr[$i]);
            if ($curmode[0] === $mode){
                // execute something here to turn mode on/off
                
                $curmode[1]=$status;
                
            }
            $res .= implode("=",$curmode)."\n";
        }
        $file = fopen($fileUrl,"w");
        fwrite($file,$res);
        fclose($file);
        return $res;
    }

    // what to display when accessing basic protection 
    public function basic(){
        $arr = array();
        // Modes name here
        $protection = array();
        $protection['name'] = 'Protection Mode';
        $protection['status'] = self::getModeStatus("protection_mode");
        $protection['code'] = "protection_mode";
        $ddos = array();
        $ddos['name'] = 'DDOS Protection';
        $ddos['status'] = self::getModeStatus("ddos_protection");
        $ddos['code'] = "ddos_protection";
        $scan = array();
        $scan['name'] = 'Scan Protection';
        $scan['status'] = self::getModeStatus("scan_protection");
        $scan['code'] = "scan_protection";

        $arr['modes'] = [$protection,$ddos,$scan];
        return view('basicSecurity',$arr);
    }   

    public function protection(){
        return view('test');
    }

    public function executeCommand(Request $req){
        $cmd = $req->cmd;
        $res = shell_exec($cmd);
        return($res);
    }

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
            return redirect("/security/protection");
        }
        return redirect()->back()->withErrors(['Login failed']);
    }
}