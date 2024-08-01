<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteFile implements ShouldQueue
{
    use Queueable;

    protected $filePath;
    
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        Storage::disk('local')->delete("test.txt");
        dd(Storage::disk('local')->exists("test.txt"));
    }
}
