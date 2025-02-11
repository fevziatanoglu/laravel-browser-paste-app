<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileView extends Model
{

    use HasFactory;
    protected $fillable = ['file_path', 'view_count', 'view_limit' , 'burn_at' , 'password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($fileView) {
            $fileView->file_path = $fileView->generateUniqueSlug();
        });

        static::deleting(function ($fileView) {
            $res = Storage::disk()->delete($fileView->file_path);
            info([$fileView->file_path=>$res]);
        });
    }

    

    public function generateUniqueSlug()
    {
        $file_path = Str::slug(Str::random(8) . '-' . Str::random(4));
        while (self::where('file_path', $file_path)->exists()) {
            $file_path = Str::slug(Str::random(8) . '-' . Str::random(4));
        }
        return $file_path;
    }
}
