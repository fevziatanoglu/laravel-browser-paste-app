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
            'view_limit' => 'nullable|numeric',
            'password' => 'nullable|string',
        ]);

        $fileView = FileView::query()->create([
            'view_limit' => $request['view_limit'],
            'view_count' => 0,
            'burn_at' => now()->addMinutes((int)$request['time_limit']),
            'password' => $request['password'] ? bcrypt($request['password']) : null,
        ])
            // to do not return password
            ->makeHidden(['password']);

        Storage::disk()->put($fileView->file_path, $request['text']);
        DeleteFile::dispatch($fileView->file_path)->delay(now()->addHours((float)$request['time_limit']));
        return view('pages/after-save', ['fileView' => $fileView, 'time_limit' => $request['time_limit']]);
    }

    public function get($file_path, Request $request)
    {

        $fileView = FileView::query()->where(
            'file_path',
            $file_path
        )->first();

        // if file does not extist
        abort_if(!isset($fileView), 404);


        if ($request->has('password')) {
            // if password wrong
            abort_if(!Hash::check($request->input('password'), $fileView->password), 401);
        } else {
            // try to save in session
            // do not show password in url
            if (!empty($fileView->password)) {
                return view('forms/password-form', ['file_path' => $fileView->file_path]);
            }
        }



        $fileView->query()->increment('view_count');

        if (!empty($fileView->view_limit)) {

            if ($fileView->view_count > $fileView->view_limit) {
                $fileView->delete();
                abort(410);
            }
         
        }
        return view('pages.file', ['fileView' => $fileView, 'fileData' => Storage::disk()->get($request['file_path'])]);
    }
}
