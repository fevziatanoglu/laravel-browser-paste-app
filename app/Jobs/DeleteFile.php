<?php

namespace App\Jobs;

use App\Models\FileView;
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
        Log::info($this->filePath);
        FileView::query()->where('file_path', $this->filePath)->delete();
        Storage::disk('local')->delete($this->filePath);
    }
}
