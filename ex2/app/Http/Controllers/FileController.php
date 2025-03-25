<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request){
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // stocké dans storage/app/public/uploads
            return response()->json(['message' => 'File uploaded', 'path' => $path], 200);
        }
        return response()->json(['message' => 'No file uploaded'], 400);

}
public function getFiles(){
    $files = Storage::disk('public')->files('uploads');
        $urls = array_map(function ($file) {
            return asset('storage/' . $file);
        }, $files);
        return response()->json($urls);
    }
}

?>
