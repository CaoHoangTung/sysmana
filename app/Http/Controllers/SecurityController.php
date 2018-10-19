<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityController extends Controller{
    public function __construct(){
        $this->middleware('admin');
    }
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
                $cmd = "echo 1";
                exec($cmd);
                
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
        $protection['info'] = "Protection Mode";

        $ddos = array();
        $ddos['name'] = 'DDOS Protection';
        $ddos['status'] = self::getModeStatus("ddos_protection");
        $ddos['code'] = "ddos_protection";
        $ddos['info'] = "DDOS Protection";

        $scan = array();
        $scan['name'] = 'Scan Protection';
        $scan['status'] = self::getModeStatus("scan_protection");
        $scan['code'] = "scan_protection";
        $scan['info'] = "Scan Protection";

        $arr['modes'] = [$protection,$ddos,$scan];
        return view('basicSecurity',$arr);
    }   

    // end basic mode

    // protection mode

    // index: return view
    public function protection(){
        $pacbot = self::getModeStatus('pacbot');
        $clamAV = self::getModeStatus('clam_av');
        $squid = self::getModeStatus('squid_service');

        $arr = array();
        $arr['pacbot'] = $pacbot;
        $arr['squid'] = $squid;
        $arr['clamAV'] = $clamAV;
        return view('protectionMode',$arr);
    }

    // get facebook id
    public function getFacebookId(Request $req){
        // change the url
        $fileToWrite = "C:\Users\DELL7470\Desktop\work\sub_proj\public\input.txt";
        $fileToExecute = "C:\Users\DELL7470\Desktop\work\sub_proj\get_id.py";
        $fileToGetResult = "C:\Users\DELL7470\Desktop\work\sub_proj\public\output.txt";

        $facebookUrl = $req->url;

        // write to input file
        $f = fopen($fileToWrite,'w');
        fwrite($f,$facebookUrl);
        fclose($f);

        // execute to write fb url
        // read from $fileToWrite and output to $fileToGetResult

        $cmd = "python ".$fileToExecute. " 2>&1";
        $output = array();
        exec($cmd,$output);
        // $output is for debug
    
        // read and return result
        $f = fopen($fileToGetResult,'r');
        $content = fread($f,filesize($fileToGetResult));
        fclose($f);
        return $content;
    }
    
}