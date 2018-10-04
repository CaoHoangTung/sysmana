<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller{
    public static $file1 = "modes.txt";
    public static $file2 = "fileList.txt";

    public function index(){
        $files = self::readFiles();
        $arr = array();
        $arr['files'] = $files;
        return view('files',$arr);
    }

    public function viewFile(Request $req){
        $file = $req->file;
        if ($file !== '1' && $file!=='2') 
            return "";
        $fileUrl = self::$file1;
        if ($file === '2') 
            $fileUrl = self::$file2;

        return file_get_contents($fileUrl);
    }

    // // get file
    // private function readFiles(){
    //     // replace this url with the respective file url of your system where the files' name are display
    //     $fileUrl = "fileList.txt";

    //     $content = file_get_contents($fileUrl);
    //     $lines = explode("\n",$content);
        
    //     return($lines);
    // }

    // // change file url
    // public function changeFile(Request $req){
    //     $fileUrl = "fileList.txt";

    //     $newUrl = $req->f;

    //     file_put_contents($fileUrl,$newUrl);
    //     return redirect()->back();
    // }

    // // view a file
    // public function viewFile(Request $req){
    //     $fileUrl = $req->f;
    //     $arr = array();
    //     $arr['fileUrl'] = $fileUrl;
    //     $arr['fileContent'] = file_exists($fileUrl)?file_get_contents($fileUrl):"";
    //     $arr['msg'] = file_exists($fileUrl)?"":"File does not exist. Click 'Save' to create the file";
    //     return view('editFile',$arr);
    // }

    // // edit a file
    public function editFile(Request $req){
        if ($req->file !== "1" && $req->file !=="2")
            return 0;

        $fileUrl = self::$file1;
        if ($req->file==="2")
            $fileUrl = $file2;
            
        $content = $req->content;

        $file = fopen($fileUrl,"w");
        fwrite($file,$content);
        fclose($file);

        return redirect()->back();
    }
}