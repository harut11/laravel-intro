<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($owner = 'all', $category_slug = null)
    {
        if ($owner === 'mine' && Auth::check()) {
            $query = Auth::user()->items();
        } else {
            $query = Item::query();
        }

        if ($category_slug) {
            $query = $query->select(['items.*'])
                ->leftJoin('item_categories', 'item_categories.id', 'items.category_id')
                ->where('item_categories.slug', '=', $category_slug);
        }
        if (request()->has('search')) {
            $query = $query->where(function($query) {
                $s = '%' . request()->get('search') . '%';
                $query->where('title', 'like', $s)
                    ->orWhere('content', 'like', $s);
            });
        }


        $models = $query->with('owner')->paginate(100000);
        $categories = ItemCategory::get();

        return view('item.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Item();
        return view('item.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:200|min:3',
            'content' => 'required|string|max:2000|min:3',
            'thumbnail' => 'image|max:102400',
            'category_id' => 'required|in:' . ItemCategory::get()->implode('id', ','),
        ]);
        $model = new Item();

        $model->title = $request->get('title');
        $model->content = $request->get('content');
        $model->owner_id = \Auth::user()->id;
        $model->category_id = $request->get('category_id');
        $model->thumbnail = $request->file('thumbnail');
        $model->save();

        return redirect()->route('items.index', 'mine');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Item::where('slug', '=', $slug)->firstOrFail();
        return view('item.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->findOwnerModel($id);
        return view('item.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:200|min:3',
            'content' => 'required|string|max:200|min:3',
            'thumbnail' => 'image|max:2048',
        ]);

        $model = $this->findOwnerModel($id);

        $model->title = $request->get('title');
        $model->content = $request->get('content');
        $model->thumbnail = $request->file('thumbnail');
        $model->save();

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->findOwnerModel($id);
        $model->delete();
        return redirect()->route('items.index');
    }

    private function findOwnerModel($id)
    {
        $model = \App\Models\Item::findOrFail($id);
        if ($model->owner_id !== Auth::id()) {
            abort(403);
        }
        return $model;
    }
}
