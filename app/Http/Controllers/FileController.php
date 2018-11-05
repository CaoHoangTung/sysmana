<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller{
    public static $files=[
        "modes.txt",
        "fileList.txt",
        "file_edit.txt",
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

        $fileContent = file_get_contents($fileUrl);

        switch ($fileIndex){
            // block files
            case 2:
                $lines = preg_split('/\r\n|\n|\r/',$fileContent);
                $contentToReturn = "";
                foreach($lines as $line){
                    $contentToReturn .= substr($line,1,strlen($line)-9)."\n";
                }
                return $contentToReturn;
        }

        return $fileContent;
    }

    // // edit a file
    public function editFile(Request $req){
        $fileIndex = intval($req->file);
        $content = $req->content;
        
        if (!is_int($fileIndex))
            return 0;
        if ($fileIndex < 0 || $fileIndex >= sizeof(self::$files))
            return 0;

        $fileUrl = self::$files[$fileIndex];
    
        switch ($fileIndex){
            // block files
            case 2:
                $lines = preg_split('/\r\n|\n|\r/',$content);
                $contentToReturn = "";
                foreach($lines as $line){
                    $contentToReturn .= "/".$line."(\?.*)?$"."\n";
                }
                $content = $contentToReturn;
        }

        $file = fopen($fileUrl,"w");
        fwrite($file,$content);
        fclose($file);

        return redirect()->back();
    }
}