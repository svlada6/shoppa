<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Menu;
use App\MenuItem;

use App\Http\Requests;
use Illuminate\Http\Request;

class MenuItemsController extends AdminController
{
    /**
     * Show the listing of the resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menuItems = MenuItem::all();

        return view('admin.menuItem.index', compact('menuItems'));
    }

    /**
     * Show form for creating resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        $mode = 'create';
        $menus = Menu::lists('name', 'id');

        return view('admin.menuItem.menuItem_create_edit', compact('mode', 'menus'));
    }

    /**
     * Store created resource
     *
     * @param  Requests\MenuItemsCreate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Requests\MenuItemsCreate $request)
    {
        Menu::findOrFail($request->get('menu_id'))->menuItems()->create($request->all());

        return redirect()->route('admin-menu-items');
    }

    /**
     * Show form for editing resource
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $mode = 'edit';
        $data = MenuItem::findOrFail($id);
        $menus = Menu::lists('name', 'id');
        $sortableMainMenu = Menu::where('name', 'main_menu')->first()->menuItems()->orderBy('order')->get();
        $sortableFooterMenu = Menu::where('name', 'footer_menu')->first()->menuItems()->orderBy('order')->get();

        return view('admin.menuItem.menuItem_create_edit',
            compact('data', 'mode', 'menus', 'sortableMainMenu', 'sortableFooterMenu'));
    }

    /**
     * Edit specific resource
     *
     * @param  int $id
     * @param  Requests\MenuItemsEdit $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, Requests\MenuItemsEdit $request)
    {
        MenuItem::findOrFail($id)->update($request->all());

        return redirect()->route('admin-menu-items');
    }

    /**
     * Delete specific resource
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        MenuItem::findOrFail($id)->delete();

        return back();
    }

    /**
     * Enable/disable statuses
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchStatus(Request $request, $id)
    {
        $this->validate($request, [
            'value' => 'required|numeric',
        ]);

        $menuItem = MenuItem::findOrFail($id)->update(['enabled' => $request->get('value')]);

        if ($menuItem) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }

    /**
     * Sort links
     *
     * @param Request $request
     */
    public function sort(Request $request)
    {
        foreach ($request->get('item') as $key => $menuId) {
            MenuItem::findOrFail($menuId)->update(['order' => $key + 1]);
        }
    }
}
