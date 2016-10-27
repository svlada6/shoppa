<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Product;
use App\ProductType;
use App\ProductVendor;
use DB;
use Cocur\Slugify\Slugify;
use File;
use App\Http\Requests\SeoPreviewRequest;

class ProductController extends AdminController
{

    /**
     * Show the form for creating new resource.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = Product::all();

        $data = DB::table('products')
            ->leftJoin('product_types', 'products.id_type', '=', 'product_types.id')
            ->leftJoin('product_vendors', 'products.id_vendor', '=', 'product_vendors.id')
            ->select('products.*', 'product_types.name as typename', 'product_vendors.name as vendorname')
            ->get();

        return view( 'admin.products.product_index', compact('data') );
    }


    /**
     * Show the form for creating new resource.
     *
     * @return void
     */
    public function getCreate()
    {
        $mode = 'create';

        $categories = ProductType::where('enabled', '1')->get();
        $vendors    = ProductVendor::where('enabled', '1')->get();

        return view( 'admin.products.product_create_edit', compact('mode', 'categories', 'vendors'));
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
            'price'         => 'required',
            'id_type'       => 'required',
	        'id_vendor'     => 'required',
	    ]);

        $slugify = new Slugify();

        $images = $request->input('addimage') ? json_encode( $request->input('addimage') ) : '';

	    Product::create([
            'name'                  => $request->input('name'),
            'sub_name'              => $request->input('sub_name'),
            'description'           => $request->input('description'),
            'id_type'               => $request->input('id_type'),
            'id_vendor'             => $request->input('id_vendor'),
            'price'                 => $request->input('price'),
            'compare_price'         => $request->input('compare_price'),
            'stock_keeping_unit'    => $request->input('stock_keeping_unit'),
            'barcode'               => $request->input('barcode'),
            'multiple_options'      => $request->input('multiple_options') ? $request->input('multiple_options') : '',
            'images'                => $images,
            'meta_title'            => $request->input('meta_title'),
            'meta_tags'             => $request->input('meta_tags'),
            'meta_description'      => $request->input('meta_description'),
            'slug'                  => $slugify->slugify($request->input('name')),
            'in_stock'              => $request->input('in_stock') ? $request->input('in_stock') : '',
            'on_offer'              => $request->input('on_offer') ? $request->input('on_offer') : '',
            'visible_at'            => $request->input('visible_at') ? $request->input('visible_at') : date('Y-m-d H:i:s'),
            'enabled'               => $request->input('enabled') ? $request->input('enabled') : '1',
        ]);

        // redirect
        return redirect('admin/products')->with('status', 'success')->with('message', 'Successfully created!');
    }


    /**
     * Show the form for edit existing resource.
     *
     * @return void
     */
    public function getEdit( $id )
    {
        $data = Product::find($id);
        $mode = 'edit';

        $categories = ProductType::where('enabled', '1')->get();
        $vendors    = ProductVendor::where('enabled', '1')->get();

        if( $data )
            return view( 'admin.products.product_create_edit', compact('data', 'mode', 'categories', 'vendors'));
        else
            return redirect('admin/products')->with('status', 'error')->with('message', 'Resource Not Found!');

        
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postEdit(Request $request, $id)
    {

        $data = Product::find($id);

        if( $data )
        {
            $this->validate($request, [
                'name'          => 'required|min:3|max:255',
                'price'         => 'required',
                'id_type'       => 'required',
                'id_vendor'     => 'required',
            ]);

            $slugify = new Slugify();

           

            if( $data->images )
            {
                $images = json_decode( $data->images, true );

                if( $request->input('addimage') )
                {
                    foreach( $request->input('addimage') as $image )
                        $images[] = $image;
                }

                $images = json_encode($images);
            }
            else
            {
                $images = $request->input('addimage') ? json_encode( $request->input('addimage') ) : '';
            }
            


            $update = [
                'name'                  => $request->input('name'),
                'sub_name'              => $request->input('sub_name'),
                'description'           => $request->input('description'),
                'id_type'               => $request->input('id_type'),
                'id_vendor'             => $request->input('id_vendor'),
                'price'                 => $request->input('price'),
                'compare_price'         => $request->input('compare_price'),
                'stock_keeping_unit'    => $request->input('stock_keeping_unit'),
                'barcode'               => $request->input('barcode'),
                'multiple_options'      => $request->input('multiple_options') ? $request->input('multiple_options') : '',
                'images'                => $images,
                'meta_title'            => $request->input('meta_title'),
                'meta_tags'             => $request->input('meta_tags'),
                'meta_description'      => $request->input('meta_description'),
                'slug'                  => $slugify->slugify($request->input('name')),
                'in_stock'              => $request->input('in_stock') ? $request->input('in_stock') : '',
                'on_offer'              => $request->input('on_offer') ? $request->input('on_offer') : '',
                'visible_at'            => $request->input('visible_at') ? $request->input('visible_at') : date('Y-m-d H:i:s'),
                'enabled'               => $request->input('enabled') ? $request->input('enabled') : '1',
            ];

            Product::where('id', $id)->update($update);

            return redirect('admin/products')->with('status', 'success')->with('message', 'Successfully updated');

        }
        else
        {
            return redirect('admin/products')->with('status', 'error')->with('message', 'Error while editing the resource!');
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
        $data = Product::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'value' => 'required|numeric',
            ]);

            $update = [
                'enabled' => $request->input('value')
            ];

            Product::where('id', $request->input('id'))->update($update);

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
        $data = Product::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id' => 'required|numeric',
            ]);

            if( $data->images )
            {
                $images = json_decode( $data->images, true );

                foreach( $images as $image )
                {
                    if(File::isFile($image))
                        File::delete($image);
                }
            }

            Product::where('id', $request->input('id'))->delete();

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
    public function postDeleteImage(Request $request)
    {
        $data = Product::find($request->input('id'));

        if( $data )
        {
            $this->validate($request, [
                'id'    => 'required|numeric',
                'value' => 'required',
            ]);

            $images = json_decode( $data->images, true );

            if(($key = array_search($request->input('value'), $images)) !== false) {
                unset($images[$key]);
            }

            foreach( $images as $image )
                $images_list[] = $image;

            $images = json_encode( $images_list );

            if(File::isFile($request->input('value')))
                File::delete($request->input('value'));

            $update = [
                'images' => $images
            ];

            Product::where('id', $request->input('id'))->update($update);

            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }


    /* Export START */

    public function export($type){

        $data = Product::leftJoin('product_types', 'products.id_type', '=', 'product_types.id')
        ->leftJoin('product_vendors', 'products.id_vendor', '=', 'product_vendors.id')
        ->select('products.id', 'products.name', 'products.enabled', 'product_types.name as typename', 'product_vendors.name as vendorname', 'products.slug', 'products.price', 'products.created_at')
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
        $product_data['data'] = $data;
        $product_data['title'] = 'Product list';
        $product_data['description'] = 'List of Products';
        $product_data['columns'] = array('No', 'Name', 'Status', 'Type', 'Vendor', 'Slug', 'Price', 'Date Added');

        if($type == "csv"){
            $this->export_to_csv($product_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $product_data['columns_width'] = array('A'     =>  3,
                'B'     =>  15,
                'C'     =>  15,
                'D'     =>  10,
                'E'     =>  10,
                'F'     =>  10,
                'G'     =>  5,
                'H'     => 15);
            $this->export_to_pdf($product_data);
        }

        return;
    }

    /* Export END */


    /*Preview functinality for products*/
    public function postPreview( Request $request )
    {
        $input = $request->all();


        return view( 'site.products.preview', compact('input'));
    }
}