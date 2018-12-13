<?php

namespace App\Models;

use File;
use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Item extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'content', 'thumbnail', 'category_id'];

    public function delete()
    {
        if (File::exists($this->thumb_path)) {
            File::delete($this->thumb_path);
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

    public function setThumbnailAttribute($file)
    {
        if ($file) {
            if (!empty($this->attributes['thumbnail'])) {
                if (\File::exists($this->thumb_path)) {
                    \File::delete($this->thumb_path);
                }
            }
            $filename = str_random() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $path = public_path('uploads/' . $filename);
            $thumb_path = public_path('uploads/thumbs/' . $filename);
            $image->insert('http://tco.am/img/theme/logo.png')->save($path);
            $image->fit(400, 300)->save($thumb_path);
            $this->attributes['thumbnail'] = $filename;
        }
    }

    public function getThumbUrlAttribute()
    {
        if (empty($this->attributes['thumbnail'])) {
            return null;
        }
        return asset('uploads/' . $this->attributes['thumbnail']);
    }

    public function getSmallThumbUrlAttribute()
    {
        if (empty($this->attributes['thumbnail'])) {
            return null;
        }
        return asset('uploads/thumbs/' . $this->attributes['thumbnail']);
    }

    public function getThumbPathAttribute()
    {
        if (empty($this->attributes['thumbnail'])) {
            return null;
        }
        return public_path('uploads/' . $this->attributes['thumbnail']);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
