<?php

namespace App\Models;

use File;
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
            $file->move(public_path('uploads'), $filename);
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
