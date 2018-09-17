<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class ServiceController extends Controller{

    // when user access /services
    public function index(){
        $result = self::readServices();
        $arr = array();
        $arr['services'] = $result;
        return view('services',$arr);
    }
    
    // read the services' status
    private function readServices(){
        // replace this url with the respective file url of your system where the services status are display
        $fileUrl = "C:\service\all.txt";

        $content = file_get_contents($fileUrl);
        $lines = explode("\n",$content);
        
        $arr = array();

        for($index = 0 ; $index < sizeof($lines); $index++)
            if (strlen($lines[$index]) >= 9){
                $line = $lines[$index];
                
                $pos = 0;
                $status = 3;// unset
                while($pos < strlen($line)){
                    if ($line[$pos] == '[' && $status == 3)
                        $status = 2;
                    
                    // check the service status
                    if ($status == 2 && ($line[$pos] == '+' || $line[$pos] == '-'))
                        $status = $line[$pos] == '+';
                    
                    $pos++;

                    if ($line[$pos] == ']')
                        break;
                }
                $pos++;
                $serviceName = "";
                while ($pos < strlen($line)){
                    if ($line[$pos] != ' ')
                        $serviceName .= $line[$pos];
                    $pos++;
                }
                
                $service = array(
                    'name' =>'',
                    'status' => '',
                ); 
                $service['name'] = $serviceName;
                $service['status'] = $status;

                array_push($arr,$service);
            }
        return $arr;
    }

    // turn a service on/off
    public function handleService($service,$status){
        $cmd = "service ".$service." ";
        $cmd .= $status==1?"stop":"start";

        $output = array();

        // logs can be found in /storage/logs/laravel.log
        exec($cmd,$output);
        foreach($output as $key=>$info)
            Log::info($info);
        return redirect()->back();
    }

    // update status of all services
    public function refreshService(){
        // replace this command with the command to update service status to file
        $cmd = 'dir';
        
        $output = array();
        exec($cmd,$output);
    }
}