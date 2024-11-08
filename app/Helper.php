<?php 

use Illuminate\Support\Str;

function sendAPI(int $code = 200,  $data = [], string $message = null)
{
    return response()->json([
        'meta' => [
            'code' => $code,
            'status' => $code >= 200 && $code < 300 ? 'Success' : 'Failed',
            'message' => $message
        ],
        'data' => $data
    ], $code);
}

function createSlug(string $string)
{
    return Str::slug($string);
}

?>