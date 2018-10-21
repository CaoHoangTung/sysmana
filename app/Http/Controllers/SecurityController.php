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

        $cmd = "";

        // loop service list, update the service status
        for ($i = 0 ; $i < sizeof($arr) ; $i++){
            $curmode = explode("=",$arr[$i]);
            // $curmode[0] = service name
            // $curmode[1] = service status
            if ($curmode[0] === $mode){
                // execute something here to turn mode on/off
                switch($mode){
                    case "http_access":
                        $cmd = "/etc/init.d/squid ".($status=="1"?"start":"stop");

                        $squid_config_url = "C:\Users\DELL7470\Desktop\work\sub_proj\squid.conf";
                        $squid_config_file = fopen($squid_config_url,"r");
                        $squid_config_content = fread($squid_config_file,filesize($squid_config_url));
                        fclose($squid_config_file);
                        // the position of the line
                        $strToFind = "http_access deny blockfiles";
                        $pos = strpos($squid_config_content,$strToFind);
                        $curpos = $pos-1;
                        $r = $pos;

                        // first, remove the '#'
                        while ($curpos >= 0 && ($squid_config_content[$curpos] == ' ' || $squid_config_content[$curpos] == '#'  )){
                            echo $squid_config_content[$curpos];
                            $curpos--;
                        }
                        $l = $curpos;
                        // return $l." ".$r;
                        $squid_config_content = substr($squid_config_content,0,$l+1)
                                                .substr($squid_config_content,$r,strlen($squid_config_content)-$r+1);
                        

                        // now, do nothing
                        if ($status){
                            // ok
                        }
                        else { // insert the '#' character
                            $squid_config_content = str_replace($strToFind,'#'.$strToFind,$squid_config_content);
                        }
    
                        // now update to the squid.conf file
                        $squid_config_file = fopen($squid_config_url,"w");
                        fwrite($squid_config_file,$squid_config_content);
                        fclose($squid_config_file);
                        return $squid_config_content." ".$l." ".$r;
                }
                if ($cmd !=="") exec($cmd);
 
                $curmode[1]=$status;
            }
            $res .= implode("=",$curmode);
            if ($i < sizeof($arr)-1)
                $res .= "\n";
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

        $arr['modes'] = [$protection,$ddos,$scan,$http_access];
        return view('basicSecurity',$arr);
    }   

    // end basic mode

    // protection mode

    // index: return view
    public function protection(){
        $pacbot = self::getModeStatus('pacbot');
        $clamAV = self::getModeStatus('clam_av');
        $squid = self::getModeStatus('squid_service');
        $http_access =self::getModeStatus('http_access');

        $arr = array();
        $arr['pacbot'] = $pacbot;
        $arr['squid'] = $squid;
        $arr['clamAV'] = $clamAV;
        $arr['http_access'] = $http_access;
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