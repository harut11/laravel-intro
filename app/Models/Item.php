<?php

namespace App\Models;

use App\Jobs\ImageResizeJob;
use Cviebrock\EloquentSluggable\Sluggable;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Image;

class Item extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'content', 'thumbnail', 'category_id'];

    public function delete()
    {
        $this->deleteImages();
    	parent::delete();
    }

    protected function deleteImages()
    {
        if (File::exists($this->thumb_path)) {
            File::delete($this->thumb_path);
        }
        if (File::exists($this->small_thumb_path)) {
            File::delete($this->small_thumb_path);
        }
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
                $this->deleteImages();
            }
            $filename = str_random() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/original'), $filename);
            $this->attributes['thumbnail'] = $filename;
            dispatch(new ImageResizeJob($filename));
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
        $thumb_url = asset('uploads/thumbs/' . $this->attributes['thumbnail']);
        if (!File::exists($this->small_thumb_path)) {
            return asset('img/loading.gif');
        }
        return $thumb_url;
    }

    public function getThumbPathAttribute()
    {
        if (empty($this->attributes['thumbnail'])) {
            return null;
        }
        return public_path('uploads/' . $this->attributes['thumbnail']);
    }

    public function getSmallThumbPathAttribute()
    {
        if (empty($this->attributes['thumbnail'])) {
            return null;
        }
        return public_path('uploads/thumbs/' . $this->attributes['thumbnail']);
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
