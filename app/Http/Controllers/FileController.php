<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller{
    public static $file1 = "modes.txt";
    public static $file2 = "ist.txt";
    public static $file3 = "odes.txt"; // change this to /etc/squid/squid.block
    public static $file4 = "fileList.txt"; // change this to /etc/squid/keyword.block
    public static $files=[
        "modes.txt",
        "fileList.txt",
        "modes.txt",
        "fileList.txt"
    ];

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $files = self::readFiles();
        $arr = array();
        $arr['files'] = $files;
        return view('files',$arr);
    }

    public function viewFile(Request $req){
        $fileIndex = intval($req->file);
        
        if (!is_int($fileIndex))
            return 0;
        if ($fileIndex < 0 || $fileIndex >= sizeof(self::$files))
            return 0;

        $fileUrl = self::$files[$fileIndex];

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
        $fileIndex = intval($req->file);
        $content = $req->content;
        
        if (!is_int($fileIndex))
            return 0;
        if ($fileIndex < 0 || $fileIndex >= sizeof(self::$files))
            return 0;

        $fileUrl = self::$files[$fileIndex];
    
        $file = fopen($fileUrl,"w");
        fwrite($file,$content);
        fclose($file);

        return redirect()->back();
    }
}