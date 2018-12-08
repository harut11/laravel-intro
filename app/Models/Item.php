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
}
