<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('storage_exists')) {
    /**
     * Check if storage exists
     *
     * @param $name
     * @param $disk
     * @param int $mode
     */
    function storage_exists($name, $disk, $mode = 0755): void
    {
        if (! Storage::disk($disk)->exists($name)) {
            Storage::disk($disk)->makeDirectory($name, $mode, true, true);
        }
    }
}