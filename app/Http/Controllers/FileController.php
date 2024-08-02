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
            'text' => 'required|string',
            'time_limit' => 'required|numeric|min:1|max:200',
            'download_limit' => 'nullable|numeric',
            'password' => 'nullable|string',
        ]);
        FileView::query()->update([
            'file_path' => 'text.txt',
            'view_limit' => $request['download_limit'],
            'view_count' => 0,
            'password' => bcrypt($request['password']),
        ]);
        Storage::disk('local')->put("test.txt", $request['text']);
        dd('save');
        // DeleteFile::dispatch("text.txt")->delay(now()->addSeconds((float)$request['time_limit']));
    }

    public function get(Request $request)
        {
            
            $fileView = FileView::query()->firstOrCreate([
                'file_path' => "text.txt"
            ]);


            if($request->has('password')){


                if(!Hash::check($request['password'] , $fileView->password)){
                    dd("wrong password");
                }


            }else{


                if(!empty($fileView->password)){
                    return view('forms/password-form');
                }


            }

           
         

            $fileView->increment('view_count');
            if(!empty($fileView->view_limit)){
                if ($fileView->view_count > $fileView->view_limit) {
                    DeleteFile::dispatch("text.txt");
                    dd('limit reached , file deleted');
                }
            }
            
            dd(Storage::disk('local')->get("test.txt"), Storage::disk('local')->exists("test.txt"), $fileView->view_count, $fileView->view_limit, $fileView->password);
            // return Storage::disk('local')->exists("test.txt")? Storage::disk('local')->get("test.txt") : "File not found.";
        }

    public function delete()
    {
        FileView::query()->delete([
            "file_path" => "text.txt"
        ]);

        Storage::disk('local')->delete("test.txt");
        dd(Storage::disk('local')->exists("test.txt"));
    }
}
