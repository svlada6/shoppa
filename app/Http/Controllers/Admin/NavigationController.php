<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class NavigationController extends AdminController
{
    /**
     * Return the listing of resources
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('post_type', 'page')->get();

        return view('admin.navigation.index', compact('posts'));
    }

    /**
     * Show form for editing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        $posts = Post::lists('title', 'id');
        $sortablePosts = Post::orderBy('order')->get();

        return view('admin.navigation.create', compact('posts', 'sortablePosts'));
    }

    /**
     * Create resource
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'links_to' => 'required'
        ]);

        $post = Post::findOrFail($request->get('titleId'));
        $this->saveLink($post, $request->get('links_to'));

        return redirect()->route('navigation-home');
    }

    /**
     * Store links for pages
     *
     * @param Post $post
     * @param string $link
     */
    private function saveLink($post, $link)
    {
        if ($post->links) {
            $post->links->update([
                'links_to' => $link
            ]);
        } else {
            $post->links()->create([
                'links_to' => $link
            ]);
        }
    }

    /**
     * Show resource for editing
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.navigation.edit', compact('post'));
    }

    /**
     * Store resource in database
     *
     * @param  int $id
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id, Request $request)
    {
        $this->validate($request, [
            'links_to' => 'required'
        ]);

        $post = Post::findOrFail($id);
        $this->saveLink($post, $request->get('links_to'));

        return redirect()->route('navigation-home');
    }

    /**
     * Delete page link
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->links->delete();

        return back();
    }

    /**
     * Sort pages
     *
     * @param Request $request
     */
    public function sort(Request $request)
    {
        foreach ($request->get('item') as $k => $itemId) {
            Post::find($itemId)->update(['order' => $k + 1]);
        }
    }
}
