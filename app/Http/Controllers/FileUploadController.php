<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileUploadController
{
    public function __invoke(Request $request): JsonResponse
    {
        $uploadedFile = Storage::putFile($request->file('file'));

        if ($uploadedFile === false) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'path' => $uploadedFile,
        ]);
    }
}
