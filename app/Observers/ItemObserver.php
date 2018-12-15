<?php

namespace App\Observers;

use App\Mail\ItemCreatedMail;
use App\Models\Item;
use Mail;

class ItemObserver
{
    public function created(Item $item)
    {
        Mail::to($item->owner->email)->send(new ItemCreatedMail($item));
    }
}
