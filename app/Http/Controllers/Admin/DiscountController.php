<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use App\Http\Controllers\AdminController;
use App\Http\Request;
use Excel;
use File;
use JSON;
use Response;

class DiscountController extends AdminController
{
    protected $discount;

    public function __construct(Discount $discount)
    {
        parent::__construct();
        $this->discount = $discount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discount->all();

        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discountTypes = $this->discount->getTypes();
        $extraConditions = $this->discount->extraConditions();

        return view('admin.discounts.create', compact('discountTypes', 'extraConditions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\DiscountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\DiscountRequest $request)
    {
        $discount_begins = $this->discount->discountStarts($request->input('discount_begins'));

        $discount_ends = $this->discount->discountEnds($request->input('discount_ends'));

        $expires = $request->get('never_expires') != null ? 1 : 0;

        Discount::create([
            'code' => $request->get('code'),
            'limit' => $request->get('limit'),
            'discount_type' => $request->get('discount_type'),
            'take' => $request->get('take'),
            'discount_extra' => $request->get('discount_extra'),
            'discount_begins' => $discount_begins,
            'discount_ends' => $discount_ends,
            'never_expires' => $expires
        ]);

        return redirect()->route('discount-home')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discountTypes = $this->discount->getTypes();
        $extraConditions = $this->discount->extraConditions();
        $discount = Discount::findOrFail($id);

        return view('admin.discounts.edit', compact('discount', 'discountTypes', 'extraConditions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\DiscountRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\DiscountRequest $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $discount_begins = $this->discount->discountStarts($request->input('discount_begins'));

        $discount_ends = $this->discount->discountEnds($request->input('discount_ends'));

        $expires = $request->get('never_expires') != null ? 1 : 0;

        $discount->update([
            'code' => $request->get('code'),
            'limit' => $request->get('limit'),
            'discount_type' => $request->get('discount_type'),
            'take' => $request->get('take'),
            'discount_extra' => $request->get('discount_extra'),
            'discount_begins' => $discount_begins,
            'discount_ends' => $discount_ends,
            'never_expires' => $expires
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return back()->with('success', 'Discount Deleted');
    }

    /**
     * Generate random code
     *
     * @return string
     */
    public function getCode()
    {
        return str_random(8);
    }

    /* Export START */

    public function export($type){

        $data = $this->discount->all();

        if(count($data) > 0){
            $counter = 1;
            foreach($data as $d){
                $d->id = $counter;
                $created_date = date( 'F j, Y', strtotime($d->created_at));
                $d->created_date = $created_date;
                unset($d->created_at);
                unset($d->updated_at);
                $counter++;
            }
        }

        $discount_data['data'] = $data;
        $discount_data['columns'] = array('No', 'Code', 'Limit', 'Discount Type', 'Take', 'Discount Extra', 'Discount Begins', 'Discount Ends', 'Never Expires', 'Date Added', 'Discount End App');
        $discount_data['title'] = 'Discount list';
        $discount_data['description'] = 'List of Discounts';

        if($type == "csv"){
            $this->export_to_csv($discount_data);
        }else if($type == "json"){
            return $this->export_to_json($data);
        }else if($type == "pdf"){
            $discount_data['columns_width'] = array('A'  =>  3,
                'B'     =>  10,
                'C'     =>  10,
                'D'     =>  10,
                'E'     =>  10,
                'F'     =>  10,
                'G'     =>  10,
                'H'     =>  10,
                'I'     =>  10,
                'J'     =>  10,
                'K'     =>  7);
            $this->export_to_pdf($discount_data);
        }

        return;
    }

    /* Export END */
    
    public function postUpdate($id, \Illuminate\Http\Request $request) {
        
        $this->validate($request, [
            'value' => 'required|numeric',
        ]);

        $discount = Discount::findOrFail($id)->update(['enabled' => $request->input('value')]);
        
        if ($discount) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }

}
