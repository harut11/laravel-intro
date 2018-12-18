<?php

namespace App\Http\Controllers;

use App\Events\CommentAdded;
use App\Models\Item;
use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $item_id)
    {
    	$this->validate($request, [
			'message' => 'required|min:1|max:200',
    	]);
    	$item = Item::query()->findOrFail($item_id);
    	$comment = new Comment([
    		'item_id' => $item->id,
    		'message' => $request->get('message'),
    	]);
    	Auth::user()->comments()->save($comment);
        event(new CommentAdded($item, $request->get('message')));
        return redirect()->back();
    }
}
