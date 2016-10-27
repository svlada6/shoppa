<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Collection;
use App\Product;
use DB;
use Cocur\Slugify\Slugify;
use File;

class CollectionController extends AdminController
{

    /**
     * Show the form for creating new resource.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = Collection::all();

        return view( 'admin.collections.collection_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';

        $products = Product::where('enabled', '=', '1')->get();

        return view( 'admin.collections.collection_create_edit', compact('mode', 'products'));
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postCreate(Request $request)
    { 
        $this->validate($request, [
            'name'          => 'required|min:3|max:255',
	    ]);

        $slugify = new Slugify();

        if( $request->file('featured_image') )
        { 
        	$destinationPath = 'uploads/collections/'.date('Y').'/'.date('m'); 
	        $extension = $request->file('featured_image')->getClientOriginalExtension(); 
	        $fileName = rand(11111, 99999) . '.' . $extension; 
	        $upload_success = $request->file('featured_image')->move($destinationPath, $fileName); 

	        if( $upload_success )
	        	$featured_image = $destinationPath.'/'.$fileName;
	        else
	        	$featured_image = '';
        }
        else
        	$featured_image = '';


	    $collection = Collection::create([
            'name'                  => $request->input('name'),
            'description'           => $request->input('description'),
            'featured_image'        => $featured_image,
            'meta_title'            => $request->input('meta_title'),
            'meta_tags'             => $request->input('meta_tags'),
            'meta_description'      => $request->input('meta_description'),
            'slug'                  => $slugify->slugify($request->input('name')),
            'enabled'               => $request->input('enabled') ? $request->input('enabled') : '1',
        ]);

        if( $collection )
        {
        	if( $request->input('products') )
	        {
	        	foreach( $request->input('products') as $product )	        		 	
					$collection->products()->attach($product);
	        }
        }

        // redirect
        return redirect('admin/collections')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = Collection::find($id);
        $mode = 'edit';

        $products = Product::where('enabled', '=', '1')->get();

		$added_products = Collection::find($id)->products()->wherePivot('collection_id', $id)->lists('product_id')->toArray();

        if( $data )
            return view( 'admin.collections.collection_create_edit', compact('data', 'mode', 'products', 'added_products'));
        else
            return redirect('admin/collections')->with('status', 'error')->with('message', 'Resource Not Found!');        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {
        $data = Collection::find($id);

        if( $data )
        {
            $this->validate($request, [
                'name'          => 'required|min:3|max:255',
            ]);

            $slugify = new Slugify();

           

            if( $request->file('featured_image') )
            {
                $destinationPath = 'uploads/collections/'.date('Y').'/'.date('m'); 
		        $extension = $request->file('featured_image')->getClientOriginalExtension(); 
		        $fileName = rand(11111, 99999) . '.' . $extension; 
		        $upload_success = $request->file('featured_image')->move($destinationPath, $fileName); 

		        if( $upload_success )
		        {
		        	if( $data->featured_image )
		        	{
		        		if( File::isFile( $data->featured_image ) )
		        			File::delete($data->featured_image);
		        	}

		        	$featured_image = $destinationPath.'/'.$fileName;
		        }
		        else
		        	$featured_image = '';
            }
            else
            	$featured_image = '';           


            $update = [
                'name'                  => $request->input('name'),
                'description'           => $request->input('description'),
                'featured_image'        => $featured_image,
                'meta_title'            => $request->input('meta_title'),
                'meta_tags'             => $request->input('meta_tags'),
                'meta_description'      => $request->input('meta_description'),
                'slug'                  => $slugify->slugify($request->input('name')),
            ];

            Collection::where('id', $id)->update($update);

            if( $request->input('products') )
	        {       		 	
				$data->products()->sync($request->input('products'));
	        }

            return redirect('admin/collections')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/collections')->with('status', 'error')->with('message', 'Error while editing the resource!');;
        }

    }


    /**
     * Updates enabled/disabled row in a table.
     *
     * @param  array  $data
     * @param  array  $request
     * @return data
     */
    public function postUpdate(Request $request)
    {
        $data = Collection::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            Collection::where('id', $request->input('id'))->update($update);

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }



    /**
     * Updates enabled/disabled row in a table.
     *
     * @param  array  $data
     * @param  array  $request
     * @return data
     */
    public function postDelete(Request $request)
    {
        $data = Collection::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            if( $data->featured_image )
            {
                if(File::isFile($data->featured_image))
                    File::delete($data->featured_image);
            }

            Collection::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    /* Export START */

    public function export($type){

        $data = Collection::select('collections.id', 'collections.name', 'collections.enabled', 'collections.slug', 'collections.created_at')
            ->get();

        if(count($data) > 0){
            $counter = 1;
            foreach($data as $d){
                $d->id = $counter;
                if($d->enabled == "1"){
                    $d->enabled = "Enabled";
                }else{
                    $d->enabled = "Disabled";
                }
                $created_date = date( 'F j, Y', strtotime($d->created_at));
                $d->created_date = $created_date;
                unset($d->created_at);
                $counter++;
            }
        }
        $collection_data['data'] = $data;
        $collection_data['title'] = 'Collection list';
        $collection_data['description'] = 'List of all Collections';
        $collection_data['columns'] = array('No', 'Name', 'Status', 'Slug', 'Date Added');

        if($type == "csv"){
            $this->export_to_csv($collection_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $collection_data['columns_width'] = array('A'     =>  3,
                'B'     =>  20,
                'C'     =>  20,
                'D'     =>  20,
                'E'     =>  20);
            $this->export_to_pdf($collection_data);
        }

        return;
    }

    /* Export END */

}