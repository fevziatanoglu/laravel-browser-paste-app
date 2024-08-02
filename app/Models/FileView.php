<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileView extends Model
{

    use HasFactory;
    protected $fillable = ['file_path', 'view_count' , 'view_limit' , 'password' ];
}
