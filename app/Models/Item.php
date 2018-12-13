<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Item extends Model
{
    use Sluggable;

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

    public function category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    abstract public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }: array
}
