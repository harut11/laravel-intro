<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function delete()
    {
		$path = public_path('uploads/' . $this->thumbnail);
        if (File::exists($path)) {
            File::delete($path);
        }
    	parent::delete();
    }

    public function owner()
    {
    	return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function getSlugAttribute(): string
    {
        return str_slug($this->title);
    }

    public function getUrlAttribute(): string
    {
        return action('ItemController@show', [$this->id, $this->slug]);
    }
}
