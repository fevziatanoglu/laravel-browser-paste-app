<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function save()
    {
        Storage::disk('local')->put("test.txt", request('text'));
        DeleteFile::dispatch("text.txt")->delay(now()->addSeconds(10));
    }

    public function get()
    {
        dd(Storage::disk('local')->get("test.txt"), Storage::disk('local')->exists("test.txt"));
        // return Storage::disk('local')->exists("test.txt")? Storage::disk('local')->get("test.txt") : "File not found.";
    }

    public function delete()
    {
        Storage::disk('local')->delete("test.txt");
        dd(Storage::disk('local')->exists("test.txt"));
    }
}
