<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Image;
use File;

class ImageResizeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $original_file_path = public_path('uploads/original/' . $this->filename);
        $thumb_path = public_path('uploads/thumbs/' . $this->filename);
        $new_path = public_path('uploads/' . $this->filename);
        $image = Image::make($original_file_path);
        $image->insert('http://tco.am/img/theme/logo.png')
            ->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($new_path);
        $image->insert('http://tco.am/img/theme/logo.png')
            ->fit(400, 300)->save($thumb_path);
        File::delete($original_file_path);
    }
}
