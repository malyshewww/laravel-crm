<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;


class FileController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'file_name' => $request->file('file_name'),
            'file_type' => $request->file_type,
            'claim_id' => $request->claim_id,
        ];
        // $filename = $request->file('file_name')->getClientOriginalName();
        $data['file_name'] = Storage::disk('public')->put('/files', $data['file_name']);
        FileUpload::firstOrCreate($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy(Request $request, FileUpload $file)
    {
        dd('deleted');
        $filename = $request->file('file_name');
        $file->delete();
        // if (Storage::exists($filename)) {
        //     Storage::delete($filename);
        // } else {
        //     echo 'File does not exists.';
        // }
    }
}