<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_name' => 'required'
        ]);
        $errors = $validator->errors();
        $json = [];
        if ($validator->fails()) {
            $json['status'] = 'error';
            foreach ($errors->getMessages() as $key => $message) {
                $json[$key] = 'error';
            }
            return response()->json($json);
        }
        $file = $request->file('file_name');
        $originalFileName = $file->getClientOriginalName();
        $data = [
            'file_name' => $request->file('file_name'),
            'file_original_name' => $originalFileName,
            'file_type' => $request->file_type,
            'claim_id' => $request->claim_id,
        ];
        // path вернет строку 'files/originalfilename'
        $path = $request->file('file_name')->storeAs(
            'files',
            $originalFileName
        );
        $data['file_name'] = Storage::disk('public')->put('/files', $data['file_name']);
        FileUpload::firstOrCreate($data);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $file = FileUpload::findOrFail($id);
        Storage::disk('public')->delete($file->file_name);
        FileUpload::where('id', $id)->forceDelete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
