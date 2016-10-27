<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use Input;
use Validator;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
 
class DropzoneController extends Controller {
 
    public function index() {
        return view('dropzone_demo');
    }
 
    public function uploadFiles(Request $request) 
    {

        $this->validate($request, [
            'file' => 'image|max:3000',
        ]);
 
        $destinationPath = 'uploads/products/'.date('Y').'/'.date('m'); // upload path
        $the_file = $request->file('file'); // getting file extension

        $extension = $the_file->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $request->file('file')->move($destinationPath, $fileName); // uploading file to given path
 
        if ($upload_success) {
            return response()->json(['status' => 'success', 'upload_path' => $destinationPath.'/'.$fileName]);
        } else {
            return response()->json('error', 400);
        }
    }
 
}
