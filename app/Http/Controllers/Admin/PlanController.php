<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Plan;
use App\Http\Requests\PlanCreateRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PlanController extends AdminController
{
    protected $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
        parent::__construct();
    }

    /**
     * Return the listing of resources
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $plans = Plan::all();

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        $mode = 'create';

        return view('admin.plans.plans_create_edit', compact('mode'));
    }

    /**
     * Create resource
     *
     * @param PlanCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(PlanCreateRequest $request)
    {
        $planId = Plan::create($request->all())->id;

        if ($request->hasFile('featured_image')) {
            $destinationPath = 'uploads/plans/' . $planId . '/';
            $imageName = $this->plan->sanitize($request->file('featured_image'));

            $request->file('featured_image')->move($destinationPath, $imageName);
        }

        Plan::findOrFail($planId)->update(['featured_image' => $imageName]);

        return redirect()->route('admin-plans');
    }

    /**
     * Show form for editing
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data = Plan::findOrFail($id);
        $mode = 'edit';

        return view('admin.plans.plans_create_edit', compact('mode', 'data'));
    }


    /**
     * Store edited resource
     *
     * @param Requests\StorePlanPostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Requests\StorePlanPostRequest $request, $id)
    {
        Plan::findOrFail($id)->update($request->all());

        if ($request->hasFile('featured_image')) {
            $imageName = Plan::storeImage($id, $request->file('featured_image'));
            Plan::findOrFail($id)->update(['featured_image' => $imageName]);
        }

        return redirect()->route('admin-plans');
    }

    /**
     * Delete resource
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $dir = public_path('uploads/plans/' . $id);
        File::deleteDirectory($dir);

        Plan::findOrfail($id)->delete();

        return back();
    }

    /**
     * Updates enabled/disabled row in a table.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'value' => 'required|numeric',
        ]);

        $plan = Plan::findOrFail($request->input('id'))->update(['enabled' => $request->input('value')]);
        if ($plan) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }
}
