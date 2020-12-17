<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('storage_get')) {
    function storage_get($filename)
    {
        return Storage::get(config('app.env') . '/' . $filename);
    }
}

if (!function_exists('storage_download')) {
    function storage_download($filename)
    {
        return Storage::download(config('app.env') . '/' . $filename);
    }
}
