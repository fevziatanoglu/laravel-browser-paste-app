<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteFile;
use App\Models\FileView;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function save(Request $request)
    {
        $request = $request->validate([
            'file_path' => 'required|string|min:3|max:30',
            'text' => 'required|string',
            'time_limit' => 'required|numeric|min:1|max:200',
            'download_limit' => 'nullable|numeric',
            'password' => 'nullable|string',
        ]);
        if(FileView::where('file_path', $request['file_path'])->exists()){
            dd('this file path already exists');    
        }
        $fileView = FileView::query()->create([
            'file_path' => $request['file_path'],
            'view_limit' => $request['download_limit'],
            'view_count' => 0,
            'password' => bcrypt($request['password']),
        ]);
        Storage::disk('local')->put($request['file_path'], $request['text']);
        DeleteFile::dispatch($request['file_path'])->delay(now()->addHours((float)$request['time_limit']));
        return view('get-page' , ['file_view' => $fileView , 'time_limit' => $request['time_limit']]);
    }

    public function get($file_path , Request $request)
        {
            
            $fileView = FileView::query()->where(
                'file_path' , $file_path
            )->first();

            
            if(!isset($fileView)) {
                dd('file not found');
            }

            if($request->has('password')){


                if(!Hash::check($request['password'] , $fileView->password)){
                    dd("wrong password");
                }


            }else{


                if(!empty($fileView->password)){
                    return view('forms/password-form' , ['file_path' => $fileView->file_path]);
                }


            }

           
         

            $fileView->increment('view_count');
            if(!empty($fileView->view_limit)){
                if ($fileView->view_count > $fileView->view_limit) {
                    DeleteFile::dispatch($file_path);
                    dd('limit reached , file deleted');
                }
            }
            
            dd(Storage::disk('local')->get($request['file_path']), Storage::disk('local')->exists($request['file_path']), $fileView->view_count, $fileView->view_limit, $fileView->password);
            // return Storage::disk('local')->exists($request['file_path'])? Storage::disk('local')->get($request['file_path']) : "File not found.";
        }

    // public function delete($file_path)
    // {
    //     DeleteFile::dispatch($file_path);
    //     dd( FileView::where('file_path', $file_path)->exists());
    // }
}
