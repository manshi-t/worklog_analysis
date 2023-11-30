<?php

namespace Mansi\WebsiteAnalytics\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ModuleWiseLogAnalysisController
{
    private $dir = 'logs';
    private $perPageRecord = 20;
    /**
     * get all directory name inside log directory.
     */
    public function index(Request $request)
    {
        $dir = storage_path($this->dir);
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
        return $folderNames;
    }

    /**
     * get all files name from given subdirectory of log directory.
     */
    public function getFiles($dir){
        $fileNames = [];
        $path = storage_path('logs');
        $files = File::allFiles($path.'/'.$dir);
        foreach($files as $file) {
            array_push($fileNames, pathinfo($file)['filename'].'.'.pathinfo($file)['extension']);
        }
        $data = $this->paginate($fileNames);
        return response()->json($data);
    }

    /**
     * get content of selected file.
     */
    public function getFileContent($dir,$data) {
        $path = storage_path('logs');
        $content = file_get_contents($path.'/'.$dir.'/'.$data);
        return response()->json($content);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $this->perPageRecord, $page, $options);
    }
}