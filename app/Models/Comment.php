<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['message', 'item_id'];

    public function item()
    {
    	return $this->belongsTo(Item::class);
    }

    public function author()
    {
    	return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
