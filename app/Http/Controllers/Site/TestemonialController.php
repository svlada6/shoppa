<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\Testemonial;
use \Illuminate\Support\Facades\Auth;
use DB;

class TestemonialController extends Controller
{

    /**
     * Show the homepage.
     *
     * @return 
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data =  Testemonial::where('user_id','=',$id)->get();
     
        return view('site.testemonial.index',compact('data'));
    }

    /**
     * Update testemonials
     * @param type $id
     * @param Request $request
     * @return type
     */

    public function postUpdate($id, Request $request)
    {
        $rules =[
                    'body' =>'required'            
                ];

        $this->validate($request,$rules);
        
        $testemonial = Testemonial::where('user_id','=',$id);
        
        if($testemonial->first())
        {
            $update = [
                        'body'=>$request->body,
                        'name'=> Auth::user()->name
            ];
            $testemonial->update($update);
        }
        else
        {
             $order =  DB::table('testemonials')->max('order');

             $create = [
                        'body'=>$request->body,
                        'user_id'=>$id,
                        'enabled' => 0,
                        'order' => $order+1,
                        'name' =>Auth::user()->name
            ];
            Testemonial::create($create);
        }

        return redirect('testemonials')->with('status', 'success')->with('message', 'Successfully updated!');
    }
    /**
     * Returns users testemonials with pagination
     */
    public function getTestemonialsPage()
    {
        $data = Testemonial::where('enabled','=',1)->orderBy('order','asc')->paginate(10);

        return view('site.testemonial.testemonial_page',compact('data'));
    }

}