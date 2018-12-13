<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use Sluggable;
    public function getSlugAttribute(): string
    {
    	return str_slug($this->name);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    abstract public function sluggable() {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }: array
}
