<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('full_url')) {
    function full_url($url)
    {
        if (strpos($url, 'http') !== 0) {
            return Storage::disk(config('admin.upload.disk'))->url($url);
        }

        return $url;
    }
}
if (!function_exists('hash_generate')) {
    function hash_generate($length = 6)
    {
        $characters = str_repeat('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', $length);

        return substr(str_shuffle($characters), 0, $length);
    }
}

if (!function_exists('fmt')) {
    function fmt($format, ...$args)
    {
        if (count($args) > 0) {
            $format = preg_replace("/\{[^\{]+\}/", '%s', $format);
            return sprintf($format, ...$args);
        } else {
            return $format;
        }
    }
}

function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || mkdir($dir, $mode)) {
        return true;
    }
    if (!mkdirs(dirname($dir), $mode)) {
        return false;
    }
    return mkdir($dir, $mode);
}
