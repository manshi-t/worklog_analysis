<?php

namespace Mansi\WebsiteAnalytics\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ModuleWiseLogAnalysisController
{
    /**
     * get all directory name inside log directory.
     */
    public function getLogFiles(Request $request)
    {
        $dir = storage_path('logs');
        $folderNames = [];
        $i = 0;
        $dirList = scandir($dir);
        foreach ($dirList as $key => $value) {
        if (strpos($value, '.') !== false) {
            }else {
                $folderNames[$i] = $value;
            $i++;
            }
        }
        return view('analytics::index',compact('folderNames'));
    }

    /**
     * get all files name from given subdirectory of log directory.
     */
    public function getData($dir){
        $fileNames = [];
        $path = storage_path('logs');
        $files = File::allFiles($path.'/'.$dir);

        foreach($files as $file) {
            if (pathinfo($file)['extension'] == 'log') {
                array_push($fileNames, pathinfo($file)['filename'].'.'.pathinfo($file)['extension']);
            }
        }
        return response()->json($fileNames);
    }

    /**
     * get content of selected file.
     */
    public function getFileContent($dir,$data) {
        $path = storage_path('logs');
        $content = file_get_contents($path.'/'.$dir.'/'.$data);
        return response()->json($content);
    }
}