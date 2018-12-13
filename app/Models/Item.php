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

    public function setThumbnailAttribute($file)
    {
        if ($file) {
            if (!empty($this->attributes['thumbnail'])) {
                $old_file_path = public_path('uploads') . '/' . $this->attributes['thumbnail'];
                if (\File::exists($old_file_path)) {
                    \File::delete($old_file_path);
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
