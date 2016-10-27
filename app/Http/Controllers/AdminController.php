<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Excel;
use File;
use JSON;
use Response;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export_to_csv($data){

        return Excel::create('file', function($excel) use ($data) {

            $excel->setTitle($data['title']);
            $excel->setDescription($data['description']);
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data['data']->toArray());
                $sheet->row(1, $data['columns']);
            });
        })->download("csv");
    }

    public function export_to_json($data){

        $fileName = time() . '_datafile.json';
        File::put(public_path('/'.$fileName), $data->toJson());
        return Response::download(public_path('/'.$fileName))->deleteFileAfterSend(true);
    }

    public function export_to_pdf($data){

        return Excel::create('file', function($excel) use ($data) {

            $excel->setTitle($data['title']);
            $excel->setDescription($data['description']);
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data['data']->toArray());
                $sheet->setAllBorders('thin');
                $sheet->row(1, $data['columns']);
                $sheet->setWidth($data['columns_width']);
            });
        })->download("pdf");
    }

    public function getShowLoginForm()
    {
        return view('admin.auth.login');
    }
}
