<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
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

        $models = $query->with('owner')->paginate(20);
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
    public function store(ItemStoreRequest $request)
    {
        $model = new Item($request->only('title', 'content', 'category_id', 'thumbnail'));
        Auth::user()->items()->save($model);

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
    public function update(ItemUpdateRequest $request, $id)
    {
        $model = $this->findOwnerModel($id)
            ->update($request->only('title', 'content', 'thumbnail'));
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
