<?php

use App\Jobs\DeleteFile;
use Illuminate\Support\Facades\Schedule;


Schedule::job(new DeleteFile())->everyMinute();