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


    public function handle(): void
    {
        $query = FileView::query()->where('burn_at', '<', now());
        foreach ($query->cursor() as $file){
            $file->delete();
        }
        
    }
}
