<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public function getSlugAttribute(): string
    {
    	return str_slug($this->name);
    }
}
