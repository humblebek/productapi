<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommonHelpers
{

    public function returnResponse($message, $newData = null, $statusCode = 200): JsonResponse
    {
        $base = ['message' => $message];

        if ($newData !== null) {
            $response = array_merge($base, ['data' => is_array($newData) ? $newData : $newData->toArray()]);
        } else {
            $response = $base;
        }

        return response()->json($response, $statusCode);
    }


    public function upload($file, $directory): string
    {
        $fileName = Str::random(5) . '.' . $file->getClientOriginalExtension();

        $file->storeAs("public/{$directory}", $fileName);

        return $fileName;
    }


    public function delete($filePath): bool
    {
        $fullPath = "public/{$filePath}";

        if (Storage::exists($fullPath)) {
            return Storage::delete($fullPath);
        }
        return false;
    }



}
